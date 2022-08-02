<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $primaryKey = 'education_id';

    protected $casts = [
        'started_study_at' => 'datetime',
        'ended_study_at' => 'datetime'
    ];
}
