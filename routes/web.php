<?php

use App\Http\Controllers\DailyTaskController;
use App\Http\Controllers\ExpirableTaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UnexpirableTaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/website-info/home-page');
})->name('site.home');

Route::get('/about', function () {
    return view('/website-info/about-the-website');
})->name('site.about');



//users---------------
Route::get('/login',function(){
    return view('/user/user-login');
})->name('user.login');

Route::get('/create-user', [UserController::class, 'create'])->name('user.create');

Route::get('/user/my-profile', [UserController::class, 'show'])->name('user.show')->middleware('auth');//avatar

Route::post('/user/store-user', [UserController::class, 'store'])->name('user.store');

Route::get('/user/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');

/*parametro já é capturado quando indicamos que vai ter parametro url */
//--------------------


Route::get('/tasks/edit-task/{id}', function(){
    return view('task.show-task');
})->name('tasks.show')->middleware('auth');

Route::get('/tasks/edit-task/{id}', function(){
    return view('task.edit-task');
})->name('tasks.edit')->middleware('auth');

Route::get('/tasks/create', function () {
    return view('task.create-task');
})->name('tasks.create')->middleware('auth');

Route::get('/tasks/choose-list', function () {
    return view('task.task-selection');
})->name('tasks.selection')->middleware('auth');

//----daily-tasks-route-----

Route::get('/daily-tasks', [DailyTaskController::class, 'index'])->name('daily.task.index')->middleware('auth');

Route::get('/daily-tasks/pending', [DailyTaskController::class, 'indexPending'])->name('daily.task.pending')->middleware('auth');

Route::get('/daily-tasks/completed-today', [DailyTaskController::class, 'indexFinishedToday'])->name('daily.task.finished')->middleware('auth');

Route::get('/daily-tasks/edit-daily-task/{id}', [DailyTaskController::class, 'edit'])->name('daily.task.edit')->middleware('auth');

Route::post('/daily-tasks/store', [DailyTaskController::class, 'store'])->name('daily.task.store')->middleware('auth');

Route::put('/daily-tasks/update/{id}', [DailyTaskController::class, 'update'])->name('daily.task.update')->middleware('auth');

Route::delete('/daily-tasks/destroy/{id}', [DailyTaskController::class, 'destroy'])->name('daily.task.destroy')->middleware('auth');

Route::put('/daily-tasks/mark-done/{id}',[DailyTaskController::class, 'markAsDone'])->name('daily.task.done')->middleware('auth');

//----tasks-----

//------------------unexpirable-tasks---------//

Route::get('/unexpirable-tasks', [UnexpirableTaskController::class, 'index'])->name('unexpirable.task.index')->middleware('auth');

Route::get('/unexpirable-tasks/pending', [UnexpirableTaskController::class, 'indexPending'])->name('unexpirable.pending.index')->middleware('auth');

Route::get('/unexpirable-tasks/finished', [UnexpirableTaskController::class, 'indexFinished'])->name('unexpirable.finished.index')->middleware('auth');

Route::get('/unexpirable-tasks/create-daily-task/', [UnexpirableTaskController::class, 'create'])->name('unexpirable.task.create')->middleware('auth');

Route::get('/unexpirable-tasks/edit-unexpirable-task/{id}', [UnexpirableTaskController::class, 'edit'])->name('unexpirable.task.edit')->middleware('auth');

Route::post('/unexpirable-tasks/store', [UnexpirableTaskController::class, 'store'])->name('unexpirable.task.store')->middleware('auth');

Route::put('/unexpirable-tasks/update/{id}', [UnexpirableTaskController::class, 'update'])->name('unexpirable.task.update')->middleware('auth');

Route::delete('/unexpirable-tasks/destroy/{id}', [UnexpirableTaskController::class, 'destroy'])->name('unexpirable.task.destroy')->middleware('auth');

Route::put('/unexpirable-tasks/mark-done/{id}',[UnexpirableTaskController::class, 'markAsDone'] )->name('unexpirable.task.done')->middleware('auth');

//------------------unexpirable-tasks---------

//--------------------expirable-tasks-routes--------

Route::get('/expirable-tasks', [ExpirableTaskController::class, 'index'])->name('expirable.task.index')->middleware('auth');

Route::get('/expirable-tasks/pending', [ExpirableTaskController::class, 'indexPending'])->name('expirable.task.pending')->middleware('auth');

Route::get('/expirable-tasks/finished', [ExpirableTaskController::class, 'indexFinished'])->name('expirable.task.finished')->middleware('auth');

Route::get('/expirable-tasks/create-expirable-task/', [ExpirableTaskController::class, 'create'])->name('expirable.task.create')->middleware('auth');

Route::get('/expirable-tasks/edit-expirable-task/{id}', [ExpirableTaskController::class, 'edit'])->name('expirable.task.edit')->middleware('auth');

Route::post('/expirable-tasks/store', [ExpirableTaskController::class, 'store'])->name('expirable.task.store')->middleware('auth');

Route::put('/expirable-tasks/update/{id}', [ExpirableTaskController::class, 'update'])->name('expirable.task.update')->middleware('auth');

Route::delete('/expirable-tasks/destroy/{id}', [ExpirableTaskController::class, 'destroy'])->name('expirable.task.destroy')->middleware('auth');

Route::put('/expirable-tasks/mark-done/{id}',[ExpirableTaskController::class, 'markAsDone'] )->name('expirable.task.done')->middleware('auth');

Route::view('/task-selection', 'tasks.selection')->name('task.selection')->middleware('auth');

//-------------------expirable-tasks-----------


//--LoginController

Route::post('/auth',[LoginController::class, 'authorizeUser'])->name('user.auth');

Route::get('/logout',[LoginController::class, 'logoutUser'])->name('logout');

//----

Route::get('/task-create', function(){
    return view('task.create-task');
});


