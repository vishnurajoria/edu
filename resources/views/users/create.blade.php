@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Create user</h1></div>

                    <div class="panel-body">
                        <form class="form-tasks" action="/users" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="userName" >User name</label>
                                    <input type="text" id="userName" class="form-control" placeholder="name" name="name" autocomplete="off" required autofocus>
                                </div>
                                <div class="col-md-4">
                                    <label for="userEmail" >User email</label>
                                    <input type="email" id="userEmail" class="form-control" placeholder="email" name="email" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="userPass" >User password</label>
                                    <input type="password" id="userPass" class="form-control" name="password" autocomplete="off" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Enrolled to courses</div>
                                        <div class="panel-body">
                                            @foreach($all_courses as $course)
                                                <input type="checkbox" name="user_courses[]" id="course_{{$course->id}}" value="{{$course->id}}">
                                                <label for="course_{{$course->id}}">{{$course->title}}</label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Roles</div>
                                        <div class="panel-body">
                                            @foreach($all_roles as $role)
                                            <input type="checkbox" name="user_roles[]" id="role_{{$role->id}}" value="{{$role->id}}">
                                            <label for="role_{{$role->id}}">{{$role->name}}</label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Member of groups</div>
                                        <div class="panel-body">
                                            @foreach($all_groups as $group)
                                            <input type="checkbox" name="user_groups[]" id="group_{{$group->id}}" value="{{$group->id}}">
                                            <label for="group_{{$group->id}}">{{$group->name}}</label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Create user</button>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-success" href="/users">Back to users</a>
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection