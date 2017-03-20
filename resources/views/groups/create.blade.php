@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Create group</h1></div>

                    <div class="panel-body">
                        <form class="form-tasks" action="/groups" method="POST">
                            {{csrf_field()}}
                            <label for="groupName">Group name</label>
                            <input type="text" id="groupName" class="form-control" placeholder="Name" name="name" required autofocus>
                            <br>
                            <label for="groupDescription">Group description</label>
                            <textarea name="description" id="groupDescription" class="form-control" cols="30" rows="3" placeholder="Description"></textarea>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <label>Group members</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Teachers</div>
                                                <div class="panel-body">
                                                    @foreach($all_teachers as $user)
                                                    <input type="checkbox" name="group_users[]" id="user_{{$user->id}}" value="{{$user->id}}">
                                                    <label for="user_{{$user->id}}">{{$user->name}}</label><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Students</div>
                                                <div class="panel-body">
                                                    @foreach($all_students as $user)
                                                        <input type="checkbox" name="group_users[]" id="user_{{$user->id}}" value="{{$user->id}}">
                                                        <label for="user_{{$user->id}}">{{$user->name}}</label><br>
                                                    @endforeach
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
                                            @foreach($all_courses as $course)
                                                <input type="checkbox" name="group_courses[]" id="course_{{$course->id}}" value="{{$course->id}}">
                                                <label for="course_{{$course->id}}">{{$course->title}}</label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Create group</button>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-success" href="/groups">Back to groups</a>
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection