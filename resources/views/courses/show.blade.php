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
                @if(Auth::user()->isEnrolledToCourse($course))
                    <div class="panel panel-default">
                        <div class="panel-heading">Course specific content</div>
                        <div class="panel-body">
                           <p>- CONTENT AVAILABLE JUST FOR ENROLLED USERS -</p>
                        </div>
                    </div>
                @else
                    <h3>You are not enrolled to this course <a class="btn btn-primary" href="#">Enroll</a></h3>
                @endif
                <a class="btn btn-primary" href="/courses">Back to courses</a>
                @if(Auth::user()->hasRole('admin') || Auth::user()->courses()->where('courses.id', $course->id)->count())
                    <a class="btn btn-success" href="/courses/{{$course->id}}/edit">Edit course</a>
                    <form style="display: inline;" method="POST" action="/courses/{{$course->id}}">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Delete course" class="btn btn-danger">
                    </form>
                @endif

                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection