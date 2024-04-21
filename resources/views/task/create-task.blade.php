@extends('layout.main-layout')
@section('title', 'Criar uma tarefa')
@section('content')
@include('layout.nav-bar')
    <main class="d-flex justify-content-center " x-data="{taskUrl: '/daily-tasks/store',urls:['/daily-tasks/store', '/unexpirable-tasks/store', '/expirable-tasks/store']}">
        <form x-bind:action="taskUrl" method="POST" class="d-flex flex-column m-3 col-lg-6">
            @csrf
            <header>
                <h1 class="text-center">Criar uma tarefa</h1>
            </header>
            <div class="form-floating">
                <input class="form-control" id="task_title" name="task_title" type="text" required placeholder="Title here">
                <label for="task_title">Título da tarefa</label>
            </div>
            <div class="form-floating mt-3">
                <textarea id="task_description" class="form-control fst-italic" name="task_description" cols="30" maxlength="255" placeholder="Your description" style="height: 160px"></textarea>
                <label for="task_description">Descrição</label>
            </div>
            <div>
                <p>Pra você, qual é a dificuldade desta tarefa?</p>
                <div class="form-check-inline">
                    <input class="form-check-input" id="task_level_easy" name="task_level" type="radio" value="1" required>
                    <label class="form-check-label" for="task_level_easy">Fácil</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" id="task_level_medium" name="task_level" type="radio" value="2">
                    <label class="form-check-label" for="task_level_medium">Médio</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" id="task_level_hard" name="task_level" type="radio" value="3">
                    <label class="form-check-label" for="task_level_hard">Dificil</label>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center">
                <label class="fw-bolder" for="task_type">Escolha o tipo da sua tarefa</label>
                <select class="form-select mb-3 mt-1" id="task_type" name="task_type" x-model="taskUrl" required>
                    <option value="/daily-tasks/store">Tarefa diária</option>
                    <option value="/unexpirable-tasks/store">Tarefa sem prazo</option>
                    <option value="/expirable-tasks/store">Tarefa com data limite</option>
                </select>
            </div>
            <div id="taskTypeDescription" class="bg-dark p-1 ">
                <p class="text-warning" x-show="taskUrl == '/daily-tasks/store'">Essa tarefa pode ser feita uma vez por dia, selecione para rotinas diárias como ler um livro ou estudar</p>
                <p class="text-warning" x-show="taskUrl == '/unexpirable-tasks/store'">Esse tipo de tarefa não tem data pra conclusão, você pode completar a qualquer momento</p>
                <p class="text-warning" x-show="taskUrl == '/expirable-tasks/store'">O único tipo de tarefa no qual você pode "falhar" se não finalizar antes do prazo escolhido, você pode completar a tarefa mesmo após o prazo</p>
            </div>
            <div x-show="taskUrl == '/expirable-tasks/store'">
                <label for="date_limit" class="mt-3">Selecione a data limite da sua tarefa</label>
                <input type="date" name="date_limit" id="date_limit"  min="{{date("Y-m-d")}}">
            </div>
            <div class="d-flex justify-content-around mt-3">
            <button type="submit" class="btn btn-success">Envia tarefa</button>
            <a href="{{ route('daily.task.index') }}" class="btn btn-danger">Cancelar criação de tarefa</a>
            </div>
        </form>
    </main>
@endsection
