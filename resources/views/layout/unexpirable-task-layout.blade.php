@foreach ($tasks as $task)
@php
    $isDone = $task->is_completed;
@endphp
<section class="taskContainerColor col-9 col-sm-6 col-md-4 col-lg-3 col-xl-3 m-3 p-1 border rounded border-3">
    <div class="d-flex flex-column align-items-center">
            <p class="fs-3">{{ $task->task_title }}</p>
            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{$task->task_description ?? 'No description'}}">
                Exibir descrição
            </button>
            <p><span>Criado em: {{ $task->created_at->format('d/m/y') }}</span></p>
            @include('layout.emoji-logic-state')
            <p>Nível da tarefa: {{ $task->taskLevel->task_level_name }}</p>
            <p>Status: <span>{{ $task->is_completed ? $task->completed_at : 'Esperando ser completada' }}</span></p>
            @if ($task->is_completed)
            <p>{{ $task->completed_at->format('d/m/y') }}</p>
            @endif
    </div>
        <div class="d-flex flex-column justify-content-around">
            <div class="d-flex justify-content-around">
                @method('PUT')
                @if (!$isDone)
                <form  action="{{route('unexpirable.task.done', $task->id_unexpirable_task) }}" method="POST">
                    <button type="submit" class="btn btn-secondary"><i class="bi bi-check-circle-fill"></i> <span>Completar <i class="bi bi-hand-index-thumb"></i></span></button>
                </form>
                @endif
                <form onsubmit="return confirm('Are you sure?This can be undone.')" action="{{route('daily.task.destroy', $task->id_unexpirable_task) }}" method="POST">
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bi bi-x-square-fill"></i>  <span>Deletar</span></button>
                </form>
            </div>
            <div class="d-flex justify-content-around mt-3">
                <a class="btn btn-warning" href="{{route('unexpirable.task.edit', $task->id_unexpirable_task)}}"><i class="bi bi-pen"></i> <span>Editar</span></a>
            </div>
        </div>
    </section>
@endforeach
