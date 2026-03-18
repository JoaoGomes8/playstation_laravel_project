@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Jogo: {{ $game->name }}</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome do Jogo</label>

                                <input type="text" name="name" class="form-control" value="{{ $game->name }}"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Data de Lançamento</label>

                                <input type="date" name="release_date" class="form-control"
                                    value="{{ $game->release_date }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estúdio Responsável</label>
                            <select name="studio_id" class="form-select" required>
                                <option value="" disabled>Escolhe um estúdio...</option>
                                @foreach ($studios as $studio)
                                    <option value="{{ $studio->id }}"
                                        {{ $game->studio_id == $studio->id ? 'selected' : '' }}>
                                        {{ $studio->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Capa do Jogo</label>
                            <input type="file" name="cover" class="form-control">
                            <small class="text-muted">Deixa em branco se não quiseres alterar a imagem. Formatos: JPG, PNG.
                                Máx: 2MB</small>


                            @if ($game->cover_path)
                                <div class="mt-3">
                                    <p class="mb-1 text-muted small">Capa atual:</p>
                                    <img src="{{ asset('storage/' . $game->cover_path) }}" alt="Capa atual"
                                        class="img-thumbnail" style="height: 120px;">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Atualizar Jogo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
