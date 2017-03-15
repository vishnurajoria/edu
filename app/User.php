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

//  - Tasks
    public function tasks(){
        return $this->hasMany(Course::class, 'user_id');
    }

//  - Courses
    public function courses(){
        return $this->hasMany(Course::class, 'author_id');
    }

    public function enrolledCourses(){
        return $this->belongsToMany(Course::class);
    }

//  - Roles
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

//  - Groups
    public function groups(){
        return $this->belongsToMany(Group::class);
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
            return $this->enrolledCourses()->attach($course);
        }
        else{
            return false;
        }
//        $this->enrolledCourses()->sync([$course->id], false);
    }


//  - Roles
//    addRole
    public function addRole(Role $role){
        $exists = \DB::table('role_user')
                ->whereUserId($this->id)
                ->whereRoleId($role->id)
                ->count() > 0;
        if(!$exists) {
            return $this->roles()->attach($role);
        }
        else{
            return false;
        }
    }

    public function getRoles(){
        return $this->roles()->get();
    }

    public function hasRole($role_to_search = 'admin'){
        $roles = $this->roles()->get();
        foreach( $roles->all() as $role){
            if($role->name === $role_to_search){
                return true;
            }
        }
        return false;
    }

}
