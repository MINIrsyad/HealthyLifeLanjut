<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_type',
        'result_data',
    ];

    protected $casts = [
        'result_data' => 'array',
    ];

    // Alias: $model->type === $model->quiz_type
    public function getTypeAttribute(): string
    {
        return $this->quiz_type;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
