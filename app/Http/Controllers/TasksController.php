<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $tasks = Task::all();
        $user_tasks = \Auth::user()->tasks()->get();
        return view('tasks.index', compact('tasks', 'user_tasks'));
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

        Task::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);
        session()->flash('message', 'Task created!');
        return redirect('/tasks');
    }

    public function delete(Task $task){

//        Delete also the comments of the deleted task
        $task->comments()->delete();

        Task::destroy($task->id);

        session()->flash('message', 'Task deleted!');
        return redirect('/tasks');
    }
}
