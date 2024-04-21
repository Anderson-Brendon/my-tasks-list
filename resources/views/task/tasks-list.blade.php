@extends('layout.main-layout')
@section('title', 'Minhas tarefas')
@section('content')
@include('layout.nav-bar')
<main>
    <header class="d-flex flex-column align-items-center">
        <h1 class="text-center mt-3">{{$title}}</h1>
    </header>
    <div class="d-flex justify-content-around align-items-center mt-3 col-lg-6">
        <a href="{{$urlAll}}" class="btn btn-dark">Todas as tarefas</a>
        <a class="btn btn-dark" href="{{ $urlPending }}">Pendentes</a>
        <a class="btn btn-dark" href="{{ $urlFinished }}">Concluídas</a>
    </div>
    <div class="d-flex justify-content-center {{ session('msgSuccess') ? '' : 'd-none' }}">
        <p class="msg-bg mt-3 p-1 text-center fs-3 tracking-in-expand-fwd-top border-3 rounded greenyellow">{{session('msgSuccess')}}</p>
    </div>
    <div class="d-flex flex-wrap justify-content-evenly align-items-center">
        <div class="d-flex justify-content-center mt-3 {{count($tasks) > 0 ? 'd-none' : ''}}">
            <p class="msg-bg text-center fs-3 p-1 text-warning">
                Nada por aqui
            </p>
        </div>
        @if($taskType === 'daily')
        @include('layout.daily-tasks-layout')

        @elseif($taskType === 'unexpirable')
        @include('layout.unexpirable-task-layout')

        @else
        @include('layout.expirable-task-layout')
        @endif
    </div>
</main>
<div class="d-flex flex-column justify-content-center align-items-center">
    {{$tasks->links()}}
</div>
@endsection
