@switch($task->taskLevel->id_task_level)
@case(1)
<i class="bi bi-emoji-smile float-start"></i>
@break
@case(2)
<i class="bi bi-emoji-expressionless float-start"></i>
@break
@case(3)
<i class="bi bi-emoji-angry float-start"></i>
@break
@endswitch
