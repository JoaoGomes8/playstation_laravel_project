@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Editar Estúdio: {{ $studio->name }}</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('studios.update', $studio->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nome do Estúdio</label>

                        <input type="text" name="name" class="form-control" value="{{ $studio->name }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Logótipo do Estúdio</label>
                        <input type="file" name="logo" class="form-control">
                        <small class="text-muted">Deixa em branco se não quiseres alterar a imagem. Formatos: JPG, PNG. Máx: 2MB</small>

                        @if($studio->logo_path)
                            <div class="mt-3">
                                <p class="mb-1 text-muted small">Logótipo atual:</p>
                                <img src="{{ asset('storage/' . $studio->logo_path) }}" alt="Logo atual" class="img-thumbnail" style="height: 120px;">
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('studios.show', $studio->id) }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Atualizar Estúdio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
