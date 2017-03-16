@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Courses</div>

                    <div class="panel-body">
                        @foreach($courses as $course)
                            <li><a href="/courses/{{$course->id}}">{{$course->title}}</a></li>
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Enrolled in</div>

                    <div class="panel-body">
                        {{--{{ dd(Auth::user()->enrolledCourses()->get(), Auth::user()->id) }}--}}
                        @if(!Auth::user()->enrolledCourses()->get()->isEmpty())
                            @foreach(Auth::user()->enrolledCourses()->get() as $course)
                                <li><a href="/courses/{{$course->id}}">{{$course->title}}</a></li>
                            @endforeach
                        @else
                            <h3>No courses</h3>
                        @endif
                    </div>
                </div>
                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('teacher'))
                    <a class="btn btn-primary" href="/courses/create">Create new course</a>
                @endif
            </div>
        </div>
    </div>

@endsection