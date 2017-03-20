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
        return $this->hasMany(Task::class, 'user_id');
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

// - Tasks
    public function hasTask(Task $task){
        return $task->user()->first()->id == $this->id;
    }

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
    }

    public function isEnrolledToCourse(Course $course){
        return $this->enrolledCourses()->where('courses.id', $course->id)->count();
    }

    public function isMemberOfGroupEnrolledToCourse(Course $course){

//        dd($course);
        $user_groups = $this->groups()->with('courses')->get();

//        dd($user_groups);

        $filtered_groups = $user_groups->filter(function ($value, $key) use ($course){

            return $value->courses()->where('course_id', $course->id)->first();
        });

        return $filtered_groups->count();

//        dd($filtered_groups);

    }

    public function getLoggedUserCoursesEnrolledByGroup(){
        $user_groups = $this->groups()->with('courses')->get();
        $hold_courses = [];
        $filtered_groups = $user_groups->transform(function ($group, $key){

            foreach($group->courses()->get() as $course){
                return $course;
            }

        });

//        dd( $user_groups, $filtered_groups );

        return $filtered_groups->unique();

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

    public static function getByRole($role_slug = 'admin'){

        return User::whereHas('roles', function ($query) use ($role_slug) {
            $query->where('name', $role_slug);
        })->get();

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
