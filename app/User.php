<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//  Relationships
    public function enrolledCourses(){
        return $this->belongsToMany(Course::class);
    }

    public function courses(){
        return $this->hasMany(Course::class, 'author_id');
    }

//  Methods
    public function addCourse(Course $course){
        $this->courses()->attach($course);
    }

    public function removeCourse(Course $course){
        $this->courses()->detach($course);
    }
}
