@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{$group->name}}</h1></div>
                    <div class="panel-body">
                        <p>Description: {{$group->description}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Group members</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Teachers</div>
                                    <div class="panel-body">
                                        @if(!$group_teachers->isEmpty())
                                            <ul>
                                                @foreach($group_teachers as $group_user)
                                                    <li>{{$group_user->name}}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <h3>No teachers</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Students</div>
                                    <div class="panel-body">
                                        @if(!$group_students->isEmpty())
                                            <ul>
                                                @foreach($group_students as $group_user)
                                                    <li>{{$group_user->name}}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <h3>No students</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Group courses</label>
                        <div class="panel panel-default">
                            <div class="panel-heading">Courses</div>
                            <div class="panel-body">
                                @if(!$group_courses->isEmpty())
                                    <ul>
                                        @foreach($group_courses as $group_course)
                                            <li><a href="/courses/{{$group_course->id}}">{{$group_course->title}}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <h3>No courses</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary" href="/groups">Back to groups</a>
                @if(Auth::user()->hasRole('admin'))
                    <a class="btn btn-success" href="/groups/{{$group->id}}/edit">Edit group</a>
                    <form style="display: inline;" method="POST" action="/groups/{{$group->id}}">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Delete group" class="btn btn-danger">
                    </form>
                @endif
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection