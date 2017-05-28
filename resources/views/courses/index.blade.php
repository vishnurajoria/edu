@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                @if(Auth::check())
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Enrolled in</div>
                                <div class="panel-body">
                                    @if(count($user_courses))
                                        <ul>
                                            @foreach($user_courses as $course)
                                                <li><a href="/courses/{{$course->id}}">{{$course->title}}</a></li>
                                            @endforeach
                                        </ul>
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
                                        <ul>
                                            @foreach($user_courses_by_group as $course)
                                                <li><a href="/courses/{{$course->id}}">{{$course->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <h3>No courses</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('teacher'))
                        <a class="btn btn-primary" href="/courses/create" style="margin-bottom: 30px;">Create new course</a>
                    @endif
                @endif
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading"><h1>All Courses--}}
                            {{--@if(isset(request()->input()['page']))--}}
                                {{--- page {{ request()->input()['page'] }}--}}
                            {{--@endif--}}
                    {{--</h1></div>--}}
                    {{--<div class="panel-body">--}}
                        {{--@foreach($courses as $course)--}}
                            {{--<div class="col-sm-6">--}}
                                    {{--<div class="panel panel-info">--}}
                                        {{--<div class="panel-heading"><a href="/courses/{{$course->id}}">{{$course->title}}</a></div>--}}
                                        {{--<div class="panel-body">--}}
                                            {{--<p>Date: {{ $course->created_at->toFormattedDateString() }}</p>--}}
                                            {{--<p>Author: {{$course->author->name}}</p>--}}
                                            {{--<p>Description: {{ str_limit($course->description, 60)}}</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--<div class="text-center">{{ $courses->links() }}</div>--}}
                {{--</div>--}}
                <div id="app-container">
                    <course-list></course-list>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection