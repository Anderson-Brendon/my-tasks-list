<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpirableTask extends Model
{
    protected $primaryKey = 'id_expirable_task';
    use HasFactory;

    public function taskLevel():BelongsTo{
        return $this->belongsTo(TaskLevel::class, 'id_task_level');
    }

    //Get the user that owns the task.
    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'id_user');
    }
}
