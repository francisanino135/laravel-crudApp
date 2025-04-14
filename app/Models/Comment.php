<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Allow mass-assignment for these fields
    protected $fillable = ['post_id', 'user_id', 'comment', 'media'];

    // Automatically cast 'media' JSON to an array
    protected $casts = [
        'media' => 'array',
    ];

    // Define relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
