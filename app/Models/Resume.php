<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resume extends Model
{
    use HasFactory;

    protected $table = 'resumes';

    protected $primaryKey = 'resume_id';

    protected $casts = [
        'contact_info' => 'array'
    ];

    protected static function boot()
    {
        self::creating(function (self $model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->name);
            }
        });

        parent::boot();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function workHistories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WorkHistory::class, 'resume_id', 'resume_id');
    }

    public function educations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Education::class, 'resume_id', 'resume_id');
    }
}
