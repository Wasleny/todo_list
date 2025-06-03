<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $query = Task::where('user_id', Auth::user()->id);
        $filter = request()->input('status');

        if ($filter) {
            $query->where('status', $filter);
        }

        $tasks = $query->simplePaginate(20);
        $tasks->appends(request()->only('status'));

        return view('tasks/index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks/create');
    }

    public function store(TaskRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            Task::create($data);

            return redirect()->route('task.index')->with('success', 'Tarefa criada com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->route('task.index')->with('error', 'Algo deu errado');
        }
    }

    public function edit($id)
    {
        try {
            if (!$this->verifyIfIsOnwner($id)) {
                throw new \Exception('Você não tem permissão para acessar essa tarefa');
            }

            $task = Task::where('id', $id)->first();
            return view('tasks/edit', ['task' => $task]);
        } catch (\Throwable $th) {
            return redirect()->route('task.index')->with('error', $th->getMessage());
        }
    }

    public function update(TaskRequest $request, $id)
    {
        try {
            if (!$this->verifyIfIsOnwner($id)) {
                throw new \Exception('Você não tem permissão para acessar essa tarefa');
            }

            $data = $request->only(['title', 'status', 'description']);

            Task::where('id', $id)->update($data);

            return redirect()->route('task.index')->with('success', 'Tarefa atualizada com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->route('task.index')->with('error', 'Algo deu errado');
        }
    }

    public function destroy($id)
    {
        try {
            if (!$this->verifyIfIsOnwner($id)) {
                throw new \Exception('Você não tem permissão para acessar essa tarefa');
            }

            Task::where('id', $id)->delete();
            return redirect()->route('task.index')->with('success', 'Tarefa excluída com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->route('task.index')->with('error', 'Algo deu errado.');
        }
    }

    protected function verifyIfIsOnwner($taskId)
    {
        return Task::where('id', $taskId)
            ->where('user_id', Auth::id())
            ->exists();
    }
}
