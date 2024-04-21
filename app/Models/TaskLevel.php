<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskLevel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_task_level';

    //Get all of the tasks for the TaskLevel
    public function dailyTasks(): HasMany
    {
        return $this->hasMany(DailyTask::class, 'id_task');
    }

    public function unexpirableTasks(): HasMany
    {
        return $this->hasMany(UnexpirableTask::class, 'id_unexpirable_task');
    }

    public function expirableTasks(): HasMany
    {
        return $this->hasMany(ExpirableTask::class, 'id_expirable_task');
    }


}
