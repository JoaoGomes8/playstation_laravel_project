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

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                        <label class="form-label">Logótipo do Estúdio</label>
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                        <small class="text-muted">Formatos aceites: JPG, PNG. Tamanho máximo: 2MB.</small>

                        @error('logo')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
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
