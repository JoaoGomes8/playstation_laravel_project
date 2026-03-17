@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h3 class="mb-3">Login</h3>

        {{-- Mostrar erros de login (ex: password errada) --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                Dados incorretos. Tenta novamente.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</div>
@endsection
