@extends('layout.main-layout')
@section('title', 'Create a task')
@section('content')
@include('layout.nav-bar')

<main>
    <header><h1 class="text-center">Choose your list of tasks: </h1></header>
    <div class="d-flex flex-column justify-content-around align-items-center">
        <a href="{{ route('daily.task.index')}}" class="btn btn-secondary">Daily Tasks</a>
        <a href="{{ route('unexpirable.task.index') }}"class="btn btn-secondary">Unexpirable tasks</a>
        <a href="{{ route('expirable.task.index') }}" class="btn btn-secondary">Tasks with date limit</a>
    </div>
</main>

@endsection
