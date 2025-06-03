@extends('layouts.app')

@section('content')
    @include('partials.form', ['route' => route('task.store'), 'title' => 'Cadastrar tarefa', 'task' => null, 'type' => 'post'])
@endsection
