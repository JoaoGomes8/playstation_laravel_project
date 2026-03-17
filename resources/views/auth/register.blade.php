@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h3 class="mb-3">Criar Conta</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="name" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Confirmar Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Registar</button>
        </form>
    </div>
</div>
@endsection
