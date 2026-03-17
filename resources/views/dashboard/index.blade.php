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

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Os Teus Dados</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        <li class="list-group-item">
                            <strong>Tipo de Conta:</strong>
                            @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <span class="badge bg-danger">Administrador</span>
                            @else
                                <span class="badge bg-success">Utilizador Normal</span>
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Membro desde:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Ações Rápidas</h5>
                </div>
                <div class="card-body d-grid gap-2 mt-2">
                    <a href="{{ route('utils.home') }}" class="btn btn-outline-primary">Ver Estúdios Públicos</a>

                    {{-- Botão que só o Admin vê --}}
                    @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                        <a href="#" class="btn btn-danger">Gerir Estúdios (Brevemente)</a>
                    @endif

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
