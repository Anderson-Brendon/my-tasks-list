<?php

namespace App\Http\Controllers;

use App\Models\DailyTask;
use App\Models\ExpirableTask;
use App\Models\Task;
use App\Models\UnexpirableTask;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30|unique:users,name',
            'password' => 'required|string|min:8',
            'email'=>'required|max:100|unique:users,email'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;

        $user->save();

        return redirect()->route('user.login')->with('success', 'Account was created successfully');
    }//erros são acessaveis no blade sem o session mas dados de array nao , ok

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userData = Auth::user();
        $dtDoneToday = DailyTask::whereDate('last_completed', '=', Carbon::today())->count();
        $dtAllTimesDone = DailyTask::where('id_user', Auth::id())->sum('completed_number');
        $dtMostRepeated = DailyTask::where('id_user', Auth::id())->where('last_completed', ">", 0)->orderBy('completed_number', 'desc')->first();
        $unexTotal = UnexpirableTask::where('id_user', Auth::id())->count();
        $unexDone = UnexpirableTask::where('id_user', Auth::id())->where('is_completed',1)->count();
        $unexPending = UnexpirableTask::where('id_user', Auth::id())->where('is_completed',0)->count();
        $expTotal = ExpirableTask::where('id_user', Auth::id())->count();
        $expBeforeDate = ExpirableTask::where('id_user', Auth::id())->whereDate('completed_at', '<' ,'date_limit')->count();
        $expAboveDate = ExpirableTask::where('id_user', Auth::id())->whereDate('completed_at', '>' ,'date_limit')->count();

        return view('user.user-profile', compact('userData', 'dtDoneToday','dtAllTimesDone','dtMostRepeated', 'unexTotal', 'unexDone', 'unexPending', 'expTotal', 'expBeforeDate', 'expAboveDate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $userData = User::where('id', Auth::id())->get();

        return view('user.edit-user', compact('userData', 'tasksDone','taskFailed', 'taskPending'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:30|unique:users,name',
            'email' => 'required',
            'motivational_quote' => 'min:30',
            'userAvatar' => 'required',
        ]);

        User::where('id', Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
            'motivational_quote' => $request->motivational_quote ?? "You didn't add a motivational quote"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $id = Auth::id();
        User::where('id', $id)->destroy();
        redirect()->route('user.login')->with(['taskDeleted' => 'Account was deleted!']);
    }
}
