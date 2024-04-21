@extends('layout/main-layout')
@section('title','Home-page')
@section('content')
<main class="vh-100 d-flex flex-column justify-content-around">
    <header>
        <h1 class="text-center">Minha lista de tarefas</h1>
    <p class="text-center">Sim é outra to-do-list, mas com laravel<i class="bi bi-emoji-neutral-fill text-warning"></i></p>
    </header>
    <div class="d-flex justify-content-around align-items-center">
        <a class="btn btn-success" href="{{route('user.login')}}">Login <i class="bi bi-box-arrow-in-right"></i></a>
        <a class="btn btn-warning" href="{{route('user.create')}}">Criar conta <i class="bi bi-person-add"></i></a>
    </div>
    <p class="text-underline fs-3 text-center">Crie, acompanhe e gerencie suas tarefas</p>
    <div class="text-center d-flex justify-content-around">
        <a class="btn btn-secondary" href="{{route('site.about')}}">Sobre o website <i class="bi bi-info-square"></i></a>
    </div>
</main>
@endsection
