@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Update group: {{$group->name}}</h1></div>

                    <div class="panel-body">
                        <form class="form-tasks" action="/groups/{{$group->id}}" method="POST">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <label for="groupName">Group name</label>
                            <input type="text" id="groupName" class="form-control" placeholder="Name" name="name" value="{{$group->name}}" required autofocus>
                            <br>
                            <label for="groupLabel">Group description</label>
                            <textarea name="description" id="groupLabel" class="form-control" cols="30" rows="3" placeholder="Description" >{{$group->description}}</textarea>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <label>Group members</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Teachers</div>
                                                <div class="panel-body">
                                                    @foreach($all_users as $user)
                                                        <input type="checkbox" name="group_users[]" id="user_{{$user->id}}" value="{{$user->id}}"
                                                           @if($group_users->where('id', $user->id)->first() && $group_users->where('id', $user->id)->first()->id === $user->id)
                                                           checked
                                                           @endif
                                                        >
                                                        <label for="user_{{$user->id}}">{{$user->name}}</label><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Students</div>
                                                <div class="panel-body">

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
                                                <input type="checkbox" name="group_courses[]" id="course_{{$course->id}}" value="{{$course->id}}"
                                                   @if($group_courses->where('id', $course->id)->first() && $group_courses->where('id', $course->id)->first()->id === $course->id)
                                                   checked
                                                    @endif
                                                >
                                                <label for="course_{{$course->id}}">{{$course->title}}</label><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit">Update group</button>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-primary" href="/groups">Back to groups</a>
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection