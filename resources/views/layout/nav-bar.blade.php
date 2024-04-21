<nav class="bg-dark d-flex justify-content-around align-items-center p-3">
    <div class="dropdown d-flex justify-content-center">
        <a class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" href="{{route('daily.task.index')}}"><i class="bi bi-list-task"></i> <span>Tarefas</span></a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item"href="{{ route('daily.task.index') }}">Tarefas diárias</a></option></li>
            <li><a class="dropdown-item" href="{{route('unexpirable.task.index')}}">Tarefas sem prazo</a></li>
            <li><a class="dropdown-item" href="{{ route('expirable.task.index') }}">Tarefas com data limite</a></li>
        </ul>
    </div>
        <a class="btn btn-secondary" href="{{route('user.show')}}"><i class="bi bi-person-circle"></i>  <span class="d-none d-sm-block">Meu perfil</span></a>
        <a class="btn btn-secondary" href="{{route('tasks.create')}}"><i class="bi bi-plus-square greenyellow"></i> <span class="d-none d-sm-block">Adicionar tarefa</span></a>
        <a class="btn btn-secondary" href="{{route('logout') }}"><i class="bi bi-box-arrow-right text-danger"></i> <span class="d-none d-sm-block">Logout</span></a>
</nav>
