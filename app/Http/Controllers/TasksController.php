<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(){
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task){
        return view('tasks.show', compact('task'));
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(){
        $this->validate(request(), [
            'title' => 'required|min:4',
            'body' => 'required|min:6',
        ]);

//        Task::create(request(['title', 'body']));
//        dd(auth()->id());
        Task::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return redirect('/tasks');
    }
}
