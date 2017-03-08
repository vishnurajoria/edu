@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Courses</div>

                    <div class="panel-body">
                        @foreach($courses as $course)
                            <li><a href="/courses/{{$course->id}}">{{$course->title}}</a></li>
                        @endforeach
                    </div>
                </div>
                <a class="btn btn-primary" href="/courses/create">Create new course</a>
            </div>
        </div>
    </div>

@endsection