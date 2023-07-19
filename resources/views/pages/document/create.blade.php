@extends('layouts.app')
 
@section('content')
    <section class="container pt-5">
        <h1 class="h5 text-center">Anexar documento</h1>
        <form action={{ route('document.store') }} method="post" enctype="multipart/form-data" class="form-documents">
            @csrf
            <div class="mt-5">
                <label for="formFile" class="form-label">Documento</label>
                <input name="document" class="form-control" type="file" id="formFile" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
          </form>
    </section>
@endsection