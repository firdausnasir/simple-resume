<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHistory extends Model
{
    use HasFactory;

    protected $table = 'work_histories';

    protected $primaryKey = 'work_history_id';

    protected $casts = [
        'started_working_at' => 'datetime',
        'ended_working_at' => 'datetime',
    ];
}
