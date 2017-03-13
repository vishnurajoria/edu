<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'description', 'group_users', 'group_courses'];

//  Relationships

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class);
    }

//  Methods

    public function addUser(User $user){

        $exists = \DB::table('group_user')
                ->whereGroupId($this->id)
                ->whereUserId($user->id)
                ->count() > 0;
        if(!$exists) {
            return $this->users()->attach($user);
        }
        else{
            return false;
        }
    }

    public function addCourse(Course $course){

        $exists = \DB::table('course_group')
                ->whereGroupId($this->id)
                ->whereCourseId($course->id)
                ->count() > 0;
        if(!$exists) {
            return $this->courses()->attach($course);
        }
        else{
            return false;
        }
    }
}
