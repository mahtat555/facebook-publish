<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

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
