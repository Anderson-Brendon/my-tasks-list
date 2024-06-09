@foreach ( $tasks as $task)
@php
$isDoneToday = $task->last_completed != null && $task->last_completed == Carbon\Carbon::now()->toDateString();
$taskColor = $isDoneToday ? 'bg-success' : 'bg-warning';
@endphp
<section class="taskContainerColor col-9 col-sm-6 col-md-4 col-lg-3 col-xl-3 m-3 p-1 border rounded border-3">
    <div class="d-flex flex-column align-items-center">
        <p class="fs-3">{{ $task->task_title }}</p>
        <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="{{$task->task_description ?? 'No description'}}">
            Exibir descrição
        </button>
        <p><span>Criado em: </span>{{ $task->created_at->format('d/m/Y') }}</p>
        <div class="d-flex justify-content-around">
            <p>Nível da tarefa: {{ $task->taskLevel->task_level_name }}</p>
            @include('layout.emoji-logic-state')
        </div>
        <div class="d-flex justify-content-around">
            @if ($isDoneToday)
            <div class="spinner-grow text-success float-left" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Status: Completada</p>
            @else
            <div class="spinner-grow text-warning float-left" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Status: Pendente</p>
            @endif
        </div>
        <p>Conclusão mais recente:
            <span>
                @if($task->last_completed != null)
                {{ Carbon\Carbon::parse($task->last_completed)->format('d/m/Y')}}
                @else
                Sem dados
                @endif
            </span>
        </p>
        <p>Número de vezes completada: {{ $task->number_of_completions }}</p>
    </div>
    <div class="d-flex flex-column justify-content-around">
        <div class="d-flex justify-content-around">
            @if(!$isDoneToday){{--not --}}
            <form action="{{ route('daily.task.done', $task->id_daily_task) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-secondary"><span>Completar <i class="bi bi-hand-index-thumb"></i></span></button>
            </form>
            @endif
            {{-- @else
            <button class="btn btn-success"><i class="bi bi-check-circle-fill"></i> Concluída</button>
             --}}
            <form onsubmit="return confirm('Tem certeza?')" action="{{ route('daily.task.destroy', $task->id_daily_task) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="bi bi-x-square-fill"></i>
                    <span>Deletar</span></button>
            </form>
        </div>
        <div class="d-flex justify-content-around mt-3">
            <a class="btn btn-warning" href="{{ route('daily.task.edit', $task->id_daily_task) }}"><i class="bi bi-pen"></i> <span>Editar</span></a>
        </div>
    </div>
</section>
@endforeach