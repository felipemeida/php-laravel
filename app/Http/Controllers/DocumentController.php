<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\ProcessDocument;
use App\Models\FailedJob;
use App\Models\Job;
use App\Models\Document;

class DocumentController extends Controller
{
    public function create()
    {
        return view('pages.document.create');
    }

    public function indexQueue()
    {
        $countQueue = Job::where('queue', ProcessDocument::$name)
            ->count();
        $countQueueFailed = FailedJob::where('queue', ProcessDocument::$name)
            ->count();
        return view('pages.document.indexQueue', compact([
            'countQueue',
            'countQueueFailed',
        ]));
    }

    public function index()
    {
        $documents = Document::orderBy('id', 'DESC')
            ->paginate(8);

        return view('pages.document.index', compact([
            'documents',
        ]));
    }

    public function store(Request $request)
    {
        $pathDocument = $request->file('document')->store('documents');
        ProcessDocument::dispatch($pathDocument)->onQueue(ProcessDocument::$name);
        return redirect()
            ->route('document.indexQueue')
            ->with('message', 'Arquivo cadastrado com sucesso!');
    }

    public function startQueue()
    {
        Artisan::call('queue:work --queue=process-documents --max-jobs=5 --stop-when-empty');

        return redirect()
            ->route('document.indexQueue')
            ->with('message', 'Arquivos Processados');
    }
}
