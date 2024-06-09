@extends('layout.main-layout')
@section('title', 'Editar tarefa')
@section('content')
@include('layout.nav-bar')
<main class="d-flex justify-content-center" x-data='{taskType:@json($putUrl)}'>
    <form action="{{$putUrl.$id}}" method="POST" class="d-flex flex-column m-3 col-lg-6">
        @csrf
        @method('PUT')
        <header>
            <h1 class="text-center">{{$title}}</h1>
        </header>
        <div class="form-floating">
        <input class="form-control" id="task_title" name="task_title" type="text" value="{{ $task->task_title }}" placeholder="task-title" required>
        <label for="task_title">Título da tarefa</label>
        </div>
        <div class="form-floating mt-3">
            <textarea class="form-control fst-italic" placeholder="{{$task->task_description ?? 'No description available'}} " id="task_description" name="task_description" cols="30" style="height: 160px" >{{ $task->task_description }}</textarea>
            <label for="task_description">Description</label>
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
                <label class="form-check-label" for="task_level_hard">Difícil</label>
            </div>
        </div>
        <div id="taskTypeDescription" class="bg-dark mt-3">
            <p class="text-warning" x-show="taskType == '/daily-tasks/update/'">Essa tarefa pode ser feita uma vez por dia, selecione para rotinas diárias como ler um livro ou estudar</p>
            <p class="text-warning" x-show="taskType == '/unexpirable-tasks/update/'">Esse tipo de tarefa não tem data pra conclusão, você pode completar a qualquer momento</p>
            <p class="text-warning" x-show="taskType == '/expirable-tasks/update/'">O único tipo de tarefa no qual você pode "falhar" se não finalizar antes do prazo escolhido, você pode completar a tarefa mesmo após o prazo</p>
        </div>
        <div class="mb-3 mt-3" x-show="taskType == '/expirable-tasks/update/'">
            <label for="date_limit">Selecione a data limite da sua tarefa</label>
            <input name="date_limit" type="date" value="{{ $task->date_limit }}" id="date_limit"  min="{{date("Y-m-d")}}">
        </div>
        <div class="d-flex justify-content-around mt-3">
            <button type="submit" class="btn btn-success">Enviar edição</button>
            <a class="btn btn-danger" href="{{route('daily.task.index')}}">Cancelar edição</a>
        </div>
    </form>
</main>
@endsection
