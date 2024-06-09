<?php

namespace App\Http\Controllers;

use App\Models\DailyTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyTaskController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = DailyTask::with(['taskLevel'])->where('id_user', Auth::id())->orderBy('created_at', 'desc')->paginate(6);
        $taskType = 'daily';
        $urlAll = '/daily-tasks';
        $urlPending = '/daily-tasks/pending';
        $urlFinished = '/daily-tasks/completed-today';
        $title = 'Todas as tarefas diárias';
        return view('task.tasks-list', compact('tasks', 'taskType', 'urlPending','urlAll','urlFinished', 'title'));
    }

    public function indexPending(){
        $tasks = DailyTask::with(['taskLevel'])->where('id_user', Auth::id())->whereNull('last_completed')->orWhere('last_completed', '<>', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->paginate(6);
        $title = 'Tarefas diárias pendentes';
        $taskType = 'daily';
        $urlAll = '/daily-tasks';
        $urlPending = '/daily-tasks/pending';
        $urlFinished = '/daily-tasks/completed-today';
        return view('task.tasks-list',compact('tasks', 'taskType', 'urlPending','urlAll', 'urlFinished', 'title'));
    }

    public function indexFinishedToday(){
        $tasks = DailyTask::with(['taskLevel'])->where('id_user', Auth::id())->whereDate('last_completed','=', Carbon::today()->toDateString())->orderBy('created_at', 'desc')->paginate(6);
        $title = 'Tarefas diárias completadas';
        $taskType = 'daily';
        $urlAll = '/daily-tasks';
        $urlPending = '/daily-tasks/pending';
        $urlFinished = '/daily-tasks/completed-today';
        return view('task.tasks-list',compact('tasks', 'taskType', 'urlPending','urlAll', 'urlFinished', 'title'));
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
            'task_type' => 'required',
        ]);

        $task = new DailyTask();

        $task->task_title = $request->task_title;
        $task->task_description = $request->task_description;
        $task->id_task_level = $request->task_level;
        $task->id_user = Auth::id();

        $task->save();

        return redirect()->route('daily.task.index')->with('msgSuccess', 'Tarefa diária foi criada');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id_task)
    {
        $task = DailyTask::with(['taskLevel'])->where('id_usuario', Auth::id())->find($id_task);
        return view('task.task-details', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $task = DailyTask::with(['taskLevel'])->where('id_user', Auth::id())->find($id);
        $id = $task->id_daily_task;
        $putUrl = '/daily-tasks/update/';
        $title = 'Editando tarefa diária';
        return view('task.edit-task', compact('id','task', 'title', 'putUrl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id_task)
    {
        $request->validate([
            'task_title' => 'required|max:60',
            'task_description'=>'max:300',
            'task_level' => 'required'
        ]);

        $taskData = ['task_title' => $request->task_title,
       'task_description' => $request->task_description,
       'id_task_level' => $request->task_level];

        DailyTask::where('id_user',Auth::id())->where('id_daily_task', $id_task)->update($taskData);

        return redirect()->route('daily.task.index')->with(['msgSuccess' => 'Tarefa diária foi editada']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id_task)
    {
        DailyTask::where('id_user',Auth::id())->find($id_task)->delete();

        return redirect()->route('daily.task.index')->with(['msgSuccess' => 'Tarefa diária foi deletada', 'txtColor' => 'text-danger']);
    }

    public function markAsDone($id){
        $date = now()->toDateString();

        DailyTask::where('id_daily_task', $id)->where('id_user', Auth::id())->increment('number_of_completions', 1,['last_completed' => $date]);

        return redirect()->route('daily.task.index')->with(['msgSuccess' => 'Tarefa diária concluída!', 'txtColor' => 'text-success']);
    }
}
