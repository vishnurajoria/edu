<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function addComment($body){
        $this->comments()->create([
            'body' => $body,
            'user_id' => auth()->id()
        ]);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
