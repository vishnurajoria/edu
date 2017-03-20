<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use App\Course;
Use Auth;

class CoursesController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index']);
    }

    public function index(){
        $courses = Course::all();
        $user_courses = Auth::check() ? Auth::user()->enrolledCourses()->get() : [];
        $user_courses_by_group = Auth::check() ? Auth::user()->getLoggedUserCoursesEnrolledByGroup() : [];
        return view('courses.index', compact('courses', 'user_courses', 'user_courses_by_group'));
    }

    public function show(Course $course){
        $enrolled_teachers = $course->getUsersByRole('teacher');
        $enrolled_students = $course->getUsersByRole('student');

        return view('courses.show', compact('course', 'enrolled_teachers', 'enrolled_students'));
    }

    public function create(){
        return view('courses.create');
    }

    public function store(){
        $this->validate(request(), [
            'title' => 'required|min:4',
            'description' => 'required|min:6',
        ]);

        Course::create([
            'title' => request('title'),
            'description' => request('description'),
            'author_id' => auth()->id()
        ]);

        session()->flash('message', 'Course created!');
        return redirect('/courses');
    }

    public function edit(Course $course){

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $group = Course::find($id);
        $group->title = $request->title;
        $group->description = $request->description;
        $group->save();
        session()->flash('message', 'Course updated!');
        return redirect('/courses/'.$id);
    }

    public function destroy(Course $course){
//        Delete also relations with users - TBD (Need to add interface to enroll users to courses first)

        Course::destroy($course->id);
        session()->flash('message', 'Course deleted!');
        return redirect('/courses');
    }
}
