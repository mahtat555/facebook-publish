<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Get the Page that owns the Post.
     */
    public function page() {
        return $this->belongsTo(Page::class);
    }

    public function user() {
        return $this->hasOneThrough(
            Post::class,
            Page::class,
            'user_id',
            'page_id',
            'id',
            'id'
        );
    }
}
