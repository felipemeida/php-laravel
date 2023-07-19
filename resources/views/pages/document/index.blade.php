@extends('layouts.app')
 
@section('content')
    <section class="container pt-5">
        <h1 class="h5 text-center pb-3">Últimos de documentos</h1>
        <table class="table mt-5 mb-5">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Título</th>
              <th scope="col">Categoria</th>
            </tr>
          </thead>
          <tbody>
            @foreach($documents as $document)
              <tr>
                <th scope="row">{{ $document->id }}</th>
                <td>{{ $document->title }}</td>
                <td>{{ $document->category->name }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </section>
@endsection