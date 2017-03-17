@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>All Tasks</h1></div>
                    <div class="panel-body">
                        @foreach($tasks as $task)
                            <li><a href="/tasks/{{$task->id}}">{{$task->title}}</a> - {{ $task->user()->first()->name }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Your Tasks</h2></div>
                    <div class="panel-body">
                        @foreach($user_tasks as $task)
                            <li><a href="/tasks/{{$task->id}}">{{$task->title}}</a></li>
                        @endforeach
                    </div>
                </div>
                <a class="btn btn-primary" href="/tasks/create">Create new task</a>
            </div>
        </div>
    </div>

@endsection