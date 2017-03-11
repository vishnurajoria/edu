@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{$course->title}}</h1></div>

                    <div class="panel-body">
                        {{--<p>Author: {{$task->user->name}}</p>--}}
                        <p>Date: {{ $course->created_at->toFormattedDateString() }}</p>
                        <p>Author: {{$course->author->name}}</p>
                        <p>Description: {{$course->description}}</p>
                    </div>
                </div>
                <form method="POST" action="/courses/{{$course->id}}">
                    {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    <a class="btn btn-primary" href="/courses">Back to courses</a>
                    <input type="submit" value="Delete course" class="btn btn-danger">
                </form>
                <ul>
                    {{--@foreach($course->comments as $comment)--}}
                        {{--<li>{{$comment->body}}</li>--}}
                    {{--@endforeach--}}
                </ul>
                {{--@if(auth()->check())--}}
                    {{--Add comment: <br>--}}
                    {{--<form method="POST" action="/courses/{{$course->id}}/comment">--}}
                        {{--{{csrf_field()}}--}}
                        {{--<textarea name="body" id="body" cols="30" rows="10" class="form-control" required></textarea>--}}
                        {{--<input type="submit" value="Add comment" class="btn btn-primary form-control">--}}
                    {{--</form>--}}
                {{--@else--}}
                    {{--<a href="/login">Login</a> to post a comment--}}
                {{--@endif--}}
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection