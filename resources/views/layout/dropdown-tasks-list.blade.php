<div class="dropdown d-flex justify-content-center mt-3">
    <a class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" href="{{route('daily.task.index')}}"><i class="bi bi-list-task"></i> <span>Minhas tarefas</span></a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item"href="{{ route('daily.task.index') }}">Tarefas diárias</a></option></li>
        <li><a class="dropdown-item" href="{{route('unexpirable.task.index')}}">Tarefas sem prazo</a></li>
        <li><a class="dropdown-item" href="{{ route('expirable.task.index') }}">Tarefas com data limite</a></li>
    </ul>
</div>
