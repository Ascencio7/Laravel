@extends('layout.app')

@section('title', 'Modificar Usuario')

@section('content')
    @include('users._form', [
        'c1' => '#4f46e5', 'c2' => '#7c3aed',
        'titulo' => 'Modificar Usuario',
        'subtitulo' => 'Actualiza los datos de la cuenta.',
        'etiqueta' => 'ID #' . $usuario->id,
        'action' => '/users/update/' . $usuario->id,
        'metodo' => 'PUT',
        'boton' => 'Guardar Cambios',
        'usuario' => $usuario,
    ])
@endsection