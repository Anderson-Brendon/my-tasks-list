@extends('layout.main-layout')
@section('title', 'Meu perfil')
@section('content')
    @include('layout.nav-bar')
    <header class="mb-3 mt-3">
        <h1 class="text-center">Seu perfil</h1>
    </header>
    <main>
        <p class="fw-bold text-center">Nome de usuário: <span>{{ $userData->name }}</span></p>
            <header>
                <h3 class="mb-3 text-center">Estatísticas de tarefas</h3>
            </header>
        <section class="d-flex flex-wrap justify-content-around">
            <div class="mt-1">
                <h3 class="text-center">Diárias: </h3>
            <ul class="list-group mt-3">
                <li class="list-group-item list-group-item-dark">Completadas hoje: <span>{{ $dtDoneToday }}</span>
                </li>
                <li class="list-group-item list-group-item-dark">Total de tarefas diárias concluídas:
                    <span>{{ $dtAllTimesDone }}</span></li>
                <li class="list-group-item list-group-item-dark">Tarefa diária mais repetida:
                    <span>{{ $dtMostRepeated->task_title ?? 'Sem dados por enquanto'}}</span></li>
            </ul>
            </div>
            <div class="mt-1">
                <h3 class="text-center">Sem prazo: </h3>
            <ul class="list-group mt-3">
                <li class="list-group-item list-group-item-dark">Total de tarefas sem prazo criadas : <span>{{ $unexTotal }}</span></li>
                <li class="list-group-item list-group-item-dark">Total de tarefas sem prazo concluídas: <span>{{ $unexDone }}</span></li>
                <li class="list-group-item list-group-item-dark">Tarefas sem prazo pendentes: <span>{{ $unexPending }}</span></li>
            </ul>
            </div>
            <div class="mt-1">
                <h3 class="text-center">Com data limite: </h3>
            <ul class="list-group mt-3">
                <li class="list-group-item list-group-item-dark">Total de tarefas com data limite completas:
                    <span>{{ $expTotal }}</span></li>
                <li class="list-group-item list-group-item-dark">Número de tarefas concluídas antes do prazo:
                    <span>{{ $expBeforeDate }}</span></li>
                <li class="list-group-item list-group-item-dark">Número de tarefas concluídas depois do prazo: <span>{{ $expAboveDate }}</span></li>
            </ul>
            </div>
        </section>
    </main>
@endsection
