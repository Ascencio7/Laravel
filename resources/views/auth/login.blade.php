@extends('layout.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <h1 class="au-title">Bienvenido</h1>
    <p class="au-sub">Inicia sesión para administrar tu inventario.</p>

    <form action="/login" method="POST">
        @csrf

        <div class="au-group">
            <label class="au-label" for="email">Correo electrónico</label>
            <input type="email" id="email" name="email"
                class="au-input @error('email') is-invalid @enderror"
                value="{{ old('email') }}" autofocus>
            @error('email')
                <span class="au-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="au-group">
            <label class="au-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="••••••••"
                class="au-input @error('password') is-invalid @enderror">
            @error('password')
                <span class="au-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="au-row">
            <label class="au-check">
                <input type="checkbox" name="remember"> Recordarme
            </label>
        </div>

        <button type="submit" class="au-btn">Iniciar sesión</button>
    </form>

    <p class="au-foot">¿No tienes cuenta? <a href="/register">Regístrate</a></p>
@endsection