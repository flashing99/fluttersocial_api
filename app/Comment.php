<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'body', 'commentable_id', 'commentable_type'
    ];

    public function author(){
        // here we write user_id to tell laravel my foreign key is user_id not author_id
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // To know is for which post if the comment is directly commented to post
    public function post(){
        return $this->morphOne(Post::class, 'commentable');
    }

    // To know is for which post if the comment is not directly commented to post, but in this way is comment to comment
    public function comment(){
        return $this->morphMany(Comment::class, 'commentable');
    }
}
