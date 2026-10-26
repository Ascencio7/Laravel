@extends('layout.app')

@section('title', 'Crear Usuario')

@section('content')
    @include('users._form', [
        'c1' => '#059669', 'c2' => '#0d9488',
        'titulo' => 'Crear Usuario',
        'subtitulo' => 'Registra un nuevo usuario con acceso al sistema.',
        'etiqueta' => 'Nuevo registro',
        'action' => '/users/store',
        'metodo' => 'POST',
        'boton' => 'Guardar Usuario',
    ])
@endsection