<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Course;

class CoursesController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(){
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course){
        return view('courses.show', compact('course'));
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

    public function delete(Course $course){
//        Delete also relations with users - TBD (Need to add interface to enroll users to courses first)

        Course::destroy($course->id);
        session()->flash('message', 'Course deleted!');
        return redirect('/courses');
    }
}
