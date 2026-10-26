@extends('layout.auth')

@section('title', 'Crear Cuenta')

@section('content')
    <h1 class="au-title">Crear cuenta</h1>
    <p class="au-sub">Regístrate para empezar a gestionar productos.</p>

    <form action="/register" method="POST">
        @csrf

        <div class="au-group">
            <label class="au-label" for="name">Nombre completo</label>
            <input type="text" id="name" name="name"
                class="au-input @error('name') is-invalid @enderror"
                value="{{ old('name') }}" autofocus>
            @error('name')
                <span class="au-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="au-group">
            <label class="au-label" for="email">Correo electrónico</label>
            <input type="email" id="email" name="email"
                class="au-input @error('email') is-invalid @enderror"
                value="{{ old('email') }}">
            @error('email')
                <span class="au-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="au-group">
            <label class="au-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres"
                class="au-input @error('password') is-invalid @enderror">
            @error('password')
                <span class="au-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="au-group" style="margin-bottom: 22px;">
            <label class="au-label" for="password_confirmation">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña"
                class="au-input">
        </div>

        <button type="submit" class="au-btn">Crear cuenta</button>
    </form>

    <p class="au-foot">¿Ya tienes cuenta? <a href="/login">Inicia sesión</a></p>
@endsection