<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Scope: hanya artikel yang sudah dipublikasikan (published_at <= now).
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    /**
     * URL gambar artikel (dari folder public/images/articles).
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('images/articles/' . $this->image) : null;
    }
}
