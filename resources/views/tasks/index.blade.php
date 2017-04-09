@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>All Tasks
                        @if(isset(request()->input()['page']))
                            - page {{ request()->input()['page'] }}
                        @endif
                    </h1></div>
                    <div class="panel-body">
                        <ul>
                        @foreach($tasks as $task)
                            <li><a href="/tasks/{{$task->id}}">{{$task->title}}</a> - {{ $task->user()->first()->name }}</li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="text-center">{{ $tasks->links() }}</div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Your Tasks</h2></div>
                    <div class="panel-body">
                        <ul>
                        @foreach($user_tasks as $task)
                            <li><a href="/tasks/{{$task->id}}">{{$task->title}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <a class="btn btn-primary" href="/tasks/create">Create new task</a>
            </div>
        </div>
    </div>

@endsection