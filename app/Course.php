<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'author_id']; // 'author_id' should not be here

//  Relationships
    public function enrolledUsers(){
        return $this->belongsToMany(User::class);
    }
    public function author(){
        return $this->belongsTo(User::class);
    }

//  Methods
    public function addUser(User $user){
        $this->users()->attach($user);
    }

    public function removeUser(User $user){
        $this->users()->detach($user);
    }
}
