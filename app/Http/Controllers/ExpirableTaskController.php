<?php

namespace App\Http\Controllers;

use App\Models\ExpirableTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpirableTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $tasks = ExpirableTask::with(['taskLevel'])->where('id_user', Auth::id())->paginate(6);
        $taskType = 'expirable';
        $urlAll = '/expirable-tasks';
        $urlPending = '/expirable-tasks/pending';
        $title = 'Tarefas com data limite';
        $urlFinished = '/expirable-tasks/finished';
        return view('task.tasks-list', compact('tasks', 'taskType','title','urlAll','urlPending', 'urlFinished'));
    }

    public function indexPending(){
        $tasks = ExpirableTask::with(['taskLevel'])->where('id_user', Auth::id())->where('is_completed', 0)->paginate(6);
        $urlPending = '/expirable-tasks/pending';
        $title = 'Tarefas com data limite pendentes';
        $urlFinished = '/expirable-tasks/finished';
        $urlAll = '/expirable-tasks';
        $taskType = 'expirable';

        return view('task.tasks-list',compact('tasks', 'taskType','title','urlAll','urlPending', 'urlFinished'));
    }

    public function indexFinished(){
        $tasks = ExpirableTask::with(['taskLevel'])->where('id_user', Auth::id())->where('is_completed', 1)->paginate(6);
        $urlPending = '/expirable-tasks/pending';
        $title = 'Tarefas com data limite completadas';
        $urlFinished = '/expirable-tasks/finished';
        $urlAll = '/expirable-tasks';
        $taskType = 'expirable';

        return view('task.tasks-list',compact('tasks', 'taskType','title','urlAll','urlPending', 'urlFinished'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create-task');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required|max:60',
            'task_description'=>'max:300',
            'task_level' => 'required',
            'date_limit' => 'required'
        ]);

        $task = new ExpirableTask();

        $task->task_title = $request->task_title;
        $task->task_description = $request->task_description;
        $task->id_task_level = $request->task_level;
        $task->date_limit = $request->date_limit;
        $task->id_user = Auth::id();

        $task->save();

        return redirect()->route('expirable.task.index')->with('taskCreate', 'Tarefa com data limite foi criada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_task)
    {
        $task = ExpirableTask::with(['taskLevel'])->where('id_user', Auth::id())->find($id_task);
        return view('task.task-details', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $task = ExpirableTask::with(['taskLevel'])->where('id_user', Auth::id())->find($id);
        $id = $task->id_expirable_task;
        $putUrl = '/expirable-tasks/update/';
        $title = 'Editando tarefa com data';
        return view('task.edit-task', compact('task', 'putUrl', 'id', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id_task)
    {
        $request->validate([
            'task_title' => 'required|max:60',
            'task_description'=>'max:300',
            'task_level' => 'required',
            'date_limit' => 'required'
           ]);

           $taskData = ['task_title' => $request->task_title,
           'task_description' => $request->task_description,
           'id_task_level' => $request->task_level,
           'date_limit' => $request->date_limit];

            ExpirableTask::where('id_user', Auth::id())->find($id_task)->update($taskData);

            return redirect()->route('expirable.task.index')->with(['msgSucess' => 'Tarefa com data limite foi atualizada']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        ExpirableTask::where('id_expirable_task', $id)->where('id_user', Auth::id())->delete();

        return redirect()->route('expirable.task.pending')->with(['msgSuccess' => 'Tarefa com data limite foi removida']);
    }

    public function markAsDone($id){
        $date = now()->toDateString();
        ExpirableTask::where('id_expirable_task', $id)->where('id_user', Auth::id())->update(['is_completed' => 1, 'completed_at' => $date]);
        return redirect()->route('expirable.task.pending')->with(['msgSuccess' => 'Tarefa com data limite foi concluída!', 'txtColor' => 'text-success']);
    }
}
