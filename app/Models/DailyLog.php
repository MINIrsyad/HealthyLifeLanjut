<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'log_date',
        'type',
        'data',
    ];

    protected $casts = [
        'log_date' => 'date',
        'data'     => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope: log hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('log_date', today());
    }

    // Scope: by type
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
