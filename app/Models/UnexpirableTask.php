<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnexpirableTask extends Model
{
    protected $primaryKey = 'id_unexpirable_task';
    
    use HasFactory;

    //Get the task level that owns the phone.
    public function taskLevel():BelongsTo{
        return $this->belongsTo(TaskLevel::class, 'id_task_level');
    }

    //Get the user that owns the task.
    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'id_user');
    }
}
