@extends('layouts.app')
 
@section('content')
    <section class="container pt-5">
        <h1 class="h5 text-center pb-3">Fila de documentos</h1>
        @if(Session::has('message'))
          <p class="alert alert-success">{{ Session::get('message') }}</p>
        @endif
        <div class="text-center mt-5">
          <p>{{ $countQueue }} Arquivo(s) na fila</p>
          <p>{{ $countQueueFailed }} Arquivo(s) com problemas</p>
          <a href="{{ route('document.startQueue') }}"><button class="btn btn-primary">Processar 5 Arquivos</button></a>
        </div>
    </section>
@endsection