@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <section class="p-5">
        <div class="row mb-5">
            <h1 class="col">Tarefas</h1>
            <a class="btn btn-dark col-2 d-flex align-items-center justify-content-center"
                href="{{ route('task.create') }}">Criar
                tarefa</a>
        </div>

        <div class="mb-5">
            <h2 class="col fs-4">Filtrar tarefas</h2>
            <a class="btn btn-outline-secondary" href="{{route('task.index', ['status' => 'Pendente'])}}">Filtrar por Pendentes</a>
            <a class="btn btn-outline-secondary" href="{{route('task.index', ['status' => 'Concluída'])}}">Filtrar por Concluídas</a>
            <a class="btn btn-outline-secondary" href="{{route('task.index', ['status' => null])}}">Ver Todas</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Status</th>
                    <th scope="col">Data de criação</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-sm btn-outline-info me-4"> <i
                                        class="bi bi-pencil-square"></i></a>

                                <form action="{{ route('task.destroy', $task) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
    </section>
@endsection
