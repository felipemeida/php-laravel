<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Document;

class ProcessDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public static $name = 'process-documents';

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $pathDocument
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $contents = Storage::get($this->pathDocument);
        $documents = json_decode($contents);

        DB::beginTransaction();

        foreach($documents->documentos as $document) {
            $this->saveDocument($document);
        }
        
        DB::commit();
    }

    private function saveDocument($document) {
        $categoryId = Category::where('name', $document->categoria)->get()[0]->id;

        $documentModel = new Document();
        $documentModel->title = $document->titulo;
        $documentModel->contents = $document->conteúdo;
        $documentModel->category_id = $categoryId;
        $documentModel->save();
    }
}
