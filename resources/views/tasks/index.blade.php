@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Tasks</div>

                    <div class="panel-body">
                        @foreach($tasks as $task)
                            <li><a href="/tasks/{{$task->id}}">{{$task->title}}</a></li>
                        @endforeach
                    </div>
                </div>
                <a class="btn btn-primary" href="/tasks/create">Create new task</a>
            </div>
        </div>
    </div>

@endsection