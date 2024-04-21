<?php

namespace App\Http\Controllers;

use App\Models\UnexpirableTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnexpirableTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $tasks = UnexpirableTask::with(['taskLevel'])->where('id_user', Auth::id())->paginate(6);
        $taskType = 'unexpirable';
        $urlAll ='/unexpirable-tasks';
        $urlPending = '/unexpirable-tasks/pending';
        $urlFinished = '/unexpirable-tasks/finished';
        $title = 'Tarefas sem prazo';
        return view('task.tasks-list', compact('tasks','taskType','title','urlAll', 'urlPending', 'urlFinished'));
    }

    public function indexPending(){
        $tasks = UnexpirableTask::with(['taskLevel'])->where('id_user', Auth::id())->where('is_completed',0)->paginate(6);
        $taskType = 'unexpirable';
        $urlAll ='/unexpirable-tasks';
        $urlPending = '/unexpirable-tasks/pending';
        $urlFinished = '/unexpirable-tasks/finished';
        $title = 'Tarefas sem prazo';
        return view('task.tasks-list',compact('tasks', 'taskType','title','urlAll', 'urlPending','urlFinished'));
    }

    public function indexFinished(){
        $tasks = UnexpirableTask::with(['taskLevel'])->where('is_completed', 1)->where('id_user', Auth::id())->paginate(6);
        $taskType = 'unexpirable';
        $urlAll ='/unexpirable-tasks';
        $urlPending = '/unexpirable-tasks/pending';
        $urlFinished = '/unexpirable-tasks/finished';
        $title = 'Tarefas sem prazo';
        return view('task.tasks-list',compact('tasks', 'taskType','title','urlAll', 'urlPending', 'urlFinished'));
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
            'task_level' => 'required'
        ]);

        $task = new UnexpirableTask();

        $task->task_title = $request->task_title;
        $task->task_description = $request->task_description;
        $task->id_task_level = $request->task_level;
        $task->id_user = Auth::id();

        $task->save();

        return redirect()->route('unexpirable.task.index')->with('taskCreate', 'Tarefa sem prazo foi criada');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $task = UnexpirableTask::with(['taskLevel'])->where('id_user',Auth::id())->whereKey($id);
        return view('task.task-details', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $task = UnexpirableTask::with(['taskLevel'])->where('id_user', Auth::id())->find($id);
        $putUrl = '/unexpirable-tasks/update/';
        $id = $task->id_unexpirable_task;
        $title = 'Editando tarefa sem prazo';
        return view('task.edit-task', compact('putUrl', 'title','task','id', ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id_task)
    {
        $request->validate([
            'task_title' => 'required|max:60',
            'task_description'=>'min:10|max:300',
            'task_level' => 'required'
        ]);

        $taskData = ['task_title' => $request->task_title,
       'task_description' => $request->task_description,
       'id_task_level' => $request->task_level];

        UnexpirableTask::where('id_user', Auth::id())->where('id_unexpirable_task', $id_task)->update($taskData);

        return redirect()->route('unexpirable.task.index')->with(['msgSuccess' => 'Tarefa sem prazo foi editada']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id_task)
    {
        UnexpirableTask::where('id_task', Auth::id())->where('id_task', $id_task)->destroy();

        redirect()->route('tasks.index')->with(['msgSuccess' => 'Tarefa sem prazo removida']);
    }

    public function markAsDone($id){
        $date = now()->toDateString();
        UnexpirableTask::where('id_unexpirable_task', $id)->where('id_user', Auth::id())->update(['is_completed' => 1, 'completed_at' => $date]);
        return redirect()->route('unexpirable.task.index')->with(['msgSuccess' => 'Tarefa sem prazo foi concluída','txtColor' => 'text-success']);
    }
}
