@foreach ($tasks as $task)
@php
    $isAboveLimit = $task->date_limit < Carbon\Carbon::now()->toDateString();
@endphp
<section class="taskContainerColor col-9 col-sm-6 col-md-4 col-lg-3 col-xl-3 m-3 p-1 border rounded border-3">
    <div class="d-flex flex-column align-items-center">
            <p class="fs-3">{{ $task->task_title }}</p>
            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{$task->task_description ?? 'No description'}}">
                Exibir descrição
            </button>
            <p>Data limite: <span>{{ Carbon\Carbon::parse($task->date_limit)->format('d/m/y') }}</span> </p>
            <p><span>Criado em: </span>{{ $task->created_at->format('d/m/y') }}</p>
            @include('layout.emoji-logic-state')
            <p>Nivel da tarefa: {{ $task->taskLevel->task_level_name }}</p>
            @if(!$isAboveLimit && !$task->is_completed)
            <p>Status: <span >Tarefa esperando ser completada</span></p>
            @elseif($isAboveLimit && !$task->is_completed)
            <p class="text-danger fw-bold">
                Status: <span>Essa tarefa em está acima do prazo de conclusão</span>
            </p>
            @else
            <p>Tarefa concluída em: {{ Carbon\Carbon::parse($task->completed_at)->format('m/d/y')}}</p>
            @endif
    </div>
        <div class="d-flex flex-column justify-content-around">
            <div class="d-flex justify-content-around">
                @if (!$task->is_completed)
                <form action="{{route('expirable.task.done', $task->id_expirable_task) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-secondary"><span>Completar <i class="bi bi-hand-index-thumb"></i></span></button>
                </form>
                @endif
                <form onsubmit="return confirm('Are you sure?This can be undone.')" action="{{route('expirable.task.destroy', $task->id_expirable_task) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bi bi-x-square-fill"></i>  <span>Deletar</span></button>
                </form>
            </div>
            <div class="d-flex justify-content-around mt-3">
                <a class="btn btn-warning" href="{{ route('expirable.task.edit', $task->id_expirable_task) }}"><i class="bi bi-pen"></i> <span>Editar</span></a>
            </div>
        </div>
    </section>
@endforeach
