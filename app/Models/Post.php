<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    /**
     * Get the Page that owns the Post.
     */
    public function page() {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get the User that owns the Post.
     */
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
