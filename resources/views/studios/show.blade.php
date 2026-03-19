@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row align-items-center mb-5 bg-light p-4 rounded shadow-sm">
        <div class="col-md-2 text-center">
            @if($studio->logo_path)
                <img src="{{ asset('storage/' . $studio->logo_path) }}" alt="{{ $studio->name }}" class="img-fluid rounded" style="max-height: 120px;">
            @else
                <img src="{{ asset('images/default.jpg') }}" alt="Sem Logo" class="img-fluid rounded" style="max-height: 120px; object-fit: contain;">
            @endif
        </div>
        <div class="col-md-7">
            <h1 class="display-5 fw-bold">{{ $studio->name }}</h1>
            <p class="text-muted mb-0">Total de jogos registados: <strong>{{ $studio->games()->count() }}</strong></p>
        </div>
        <div class="col-md-3 text-md-end mt-3 mt-md-0">
            <div class="d-flex flex-column align-items-end">
                <a href="{{ route('utils.home') }}" class="btn btn-outline-secondary mb-2">Voltar</a>

                @auth
                    @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                        <div class="d-flex gap-2">
                            <a href="{{ route('games.create', ['studio_id' => $studio->id]) }}" class="btn btn-success" title="Adicionar Jogo">+ Jogo</a>

                            <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-primary" title="Editar Estúdio">Editar</a>

                            <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" class="d-inline" onsubmit="return confirm('ATENÇÃO: Isto vai apagar o estúdio e TODOS os seus jogos. Tens a certeza absoluta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Apagar Estúdio">Apagar</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <hr>

    <h3 class="mb-4">Jogos Desenvolvidos</h3>

    <div class="row">
        @forelse($studio->games as $game)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($game->cover_path)
                        <img src="{{ asset('storage/' . $game->cover_path) }}" class="card-img-top p-2" alt="{{ $game->name }}" style="height: 280px; object-fit: cover; border-radius: 12px;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top p-2" alt="Sem Capa" style="height: 280px; object-fit: cover; border-radius: 12px;">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $game->name }}</h5>
                        <p class="card-text small text-muted mb-0">
                            Lançamento:
                            @if($game->release_date)
                            {{-- carbon é uma ferramenta para a manipulação de datas e horas mais simples--}}
                                {{ \Carbon\Carbon::parse($game->release_date)->format('d/m/Y') }}
                            @else
                                Não definido
                            @endif
                        </p>
                    </div>

                    @auth
                        <div class="card-footer bg-transparent border-0 text-center pb-3">

                            {{-- Qualquer pessoa autenticada vê o botão Editar --}}
                            <a href="{{ route('games.edit', $game->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                            {{-- APENAS os Administradores veem o botão Apagar --}}
                            @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tens a certeza que queres apagar este jogo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Apagar</button>
                                </form>
                            @endif

                        </div>
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center shadow-sm">
                    Ainda não existem jogos registados para o estúdio {{ $studio->name }}.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
