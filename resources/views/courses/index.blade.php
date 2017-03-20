@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>All Courses</h1></div>
                    <div class="panel-body">
                        @foreach($courses as $course)
                            <li><a href="/courses/{{$course->id}}">{{$course->title}}</a></li>
                        @endforeach
                    </div>
                </div>
                @if(Auth::check())
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Enrolled in</div>
                                <div class="panel-body">
                                    @if(count($user_courses))
                                        @foreach($user_courses as $course)
                                            <li><a href="/courses/{{$course->id}}">{{$course->title}}</a></li>
                                        @endforeach
                                    @else
                                        <h3>No courses</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Enrolled in by group</div>
                                <div class="panel-body">
                                    @if(count($user_courses_by_group))
                                        @foreach($user_courses_by_group as $course)
                                            <li><a href="/courses/{{$course->id}}">{{$course->title}}</a></li>
                                        @endforeach
                                    @else
                                        <h3>No courses</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('teacher'))
                        <a class="btn btn-primary" href="/courses/create">Create new course</a>
                    @endif
                @endif
            </div>
        </div>
    </div>

@endsection