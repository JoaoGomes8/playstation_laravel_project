@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card bg-dark text-white shadow">
                    <div class="card-body p-4">
                        <h2 class="display-6">Bem-vindo, {{ Auth::user()->name }}!</h2>
                        <p class="lead mb-0">Esta é a tua área de gestão do PlayStation CRM.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card shadow-sm border-0 bg-primary text-white h-100 rounded-3">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h5 class="card-title text-uppercase mb-2">Estúdios Registados</h5>
                        <h1 class="display-2 fw-bold">{{ $totalStudios }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-success text-white h-100 rounded-3">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                        <h5 class="card-title text-uppercase mb-2">Jogos na Base de Dados</h5>
                        <h1 class="display-2 fw-bold">{{ $totalGames }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Os Teus Dados</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>
                            <li class="list-group-item">
                                <strong>Tipo de Conta:</strong>
                                @if (Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                    <span class="badge bg-danger">Administrador</span>
                                @else
                                    <span class="badge bg-success">Utilizador Normal</span>
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Membro desde:</strong>
                                {{ Auth::user()->created_at->format('d/m/Y') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Ações Rápidas</h5>
                    </div>
                    <div class="card-body d-grid gap-2 mt-2">
                        <a href="{{ route('utils.home') }}" class="btn btn-outline-primary">Ver Estúdios Públicos</a>



                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-dark w-100 mt-3">Terminar Sessão</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
