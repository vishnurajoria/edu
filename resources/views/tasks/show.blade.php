@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{$task->title}}</h1></div>
                    <div class="panel-body">
                        <p>Author: {{$task->user->name}}</p>
                        <p>Date: {{ $task->created_at->toFormattedDateString() }}</p>
                        <p>Description: {{$task->body}}</p>
                    </div>
                </div>

                <a class="btn btn-primary" href="/tasks">Back to tasks</a>
                @if(Auth::user()->hasRole('admin') || Auth::user()->hasTask($task))
                    <form style="display: inline;" method="POST" action="/tasks/{{$task->id}}">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}

                        <input type="submit" value="Delete task" class="btn btn-danger">
                    </form>
                @endif
                <ul>
                    @foreach($task->comments as $comment)
                        <li>{{$comment->body}}</li>
                    @endforeach
                </ul>
                @if(auth()->check())
                    Add comment: <br>
                    <form method="POST" action="/tasks/{{$task->id}}/comment">
                        {{csrf_field()}}
                        <textarea name="body" id="body" cols="30" rows="10" class="form-control" required></textarea>
                        <input type="submit" value="Add comment" class="btn btn-primary form-control">
                    </form>
                @else
                    <a href="/login">Login</a> to post a comment
                @endif
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection