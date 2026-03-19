@extends('layouts.main')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Estúdios PlayStation</h1>
            <p class="lead">Explora os estúdios que definem gerações de jogos.</p>
        </div>
        @auth
            @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                <div class="col-md-4 text-md-end align-self-center">
                    <a href="{{ route('studios.create') }}" class="btn btn-success">+ Novo Estúdio</a>
                </div>
            @endif
        @endauth
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('utils.home') }}" method="GET">
                <div class="input-group shadow-sm">
                    <input type="text" name="search" class="form-control" placeholder="Procurar por nome do estúdio..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>

                    @if(request('search'))
                        <a href="{{ route('utils.home') }}" class="btn btn-outline-danger">Limpar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <hr>

    <div class="row">
        @forelse($studios as $studio)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($studio->logo_path)
                        <img src="{{ asset('storage/' . $studio->logo_path) }}" class="card-img-top p-3" alt="{{ $studio->name }}" style="height: 200px; object-fit: contain;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top p-3" alt="Sem Logo" style="height: 200px; object-fit: contain;">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $studio->name }}</h5>
                        <p class="card-text small text-muted">
                            {{ $studio->games()->count() }} Jogos Registados
                        </p>
                        <a href="{{ route('studios.show', $studio->id) }}" class="btn btn-outline-dark btn-sm">Ver Jogos</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Ainda não existem estúdios registados.
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $studios->links() }}
    </div>
@endsection
