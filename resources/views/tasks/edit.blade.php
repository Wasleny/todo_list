@extends('layouts.app')

@section('content')
    @include('partials.form', ['route' => route('task.update', $task), 'title' => 'Editar tarefa', 'task' => $task, 'type' => 'update'])
@endsection
