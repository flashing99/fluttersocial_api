<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',  'body', 'status'
    ];


    public function author(){
        // here we write user_id to tell laravel my foreign key is user_id not author_id
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /*
     * This relationship is to define the polymorphic between Post and Comment
     * second parameter must be the word that we used in migration table
     *
     */
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
}
