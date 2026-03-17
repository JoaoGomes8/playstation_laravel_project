@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Adicionar Novo Estúdio</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('studios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nome do Estúdio</label>
                        <input type="text" name="name" class="form-control" placeholder="Ex: Naughty Dog" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logótipo do Estúdio</label>
                        <input type="file" name="logo" class="form-control">
                        <small class="text-muted">Formatos: JPG, PNG. Máx: 2MB</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('utils.home') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Estúdio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
