<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

     /**
     * Get the posts for the Page.
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the User that owns the Page.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
