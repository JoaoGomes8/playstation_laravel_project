@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Adicionar Novo Jogo</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nome do Jogo</label>
                            <input type="text" name="name" class="form-control" placeholder="Ex: God of War Ragnarök" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Data de Lançamento</label>
                            <input type="date" name="release_date" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estúdio Responsável</label>
                        <select name="studio_id" class="form-select" required>
                            <option value="" disabled selected>Escolhe um estúdio...</option>
                            @foreach($studios as $studio)
                                <option value="{{ $studio->id }}"
                                    {{ $selectedStudio == $studio->id ? 'selected' : '' }}>
                                    {{ $studio->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Capa do Jogo</label>
                        <input type="file" name="cover" class="form-control">
                        <small class="text-muted">Formatos: JPG, PNG. Máx: 2MB</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        {{-- O botão voltar usa a função url()->previous() para voltar exatamente de onde viemos --}}
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar Jogo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
