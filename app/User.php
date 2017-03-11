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

//  - Courses
    public function enrolledCourses(){
        return $this->belongsToMany(Course::class);
    }

    public function courses(){
        return $this->hasMany(Course::class, 'author_id');
    }

//  - Roles
    public function roles(){
        return $this->belongsToMany(Role::class);
    }


//  Methods

//  - Courses
    public function addCourse(Course $course){
        $this->courses()->attach($course);
    }

    public function removeCourse(Course $course){
        $this->courses()->detach($course);
    }

    public function enrollToCourse(Course $course){
        $exists = \DB::table('course_user')
                ->whereUserId($this->id)
                ->whereCourseId($course->id)
                ->count() > 0;
        if(!$exists) {
            $this->enrolledCourses()->attach($course);
        }

//        $this->enrolledCourses()->sync([$course->id], false);
    }


//  - Roles
//    addRole

}
