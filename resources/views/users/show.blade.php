@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h1>{{$user->name}}</h1></div>
                            <div class="panel-body">
                                <p>Joined: {{ $user->created_at->toFormattedDateString() }}</p>
                                <p>Email: {{$user->email}}</p>
                                <p>Role:
                                @foreach($user->roles()->get() as $role)
                                    {{ $role->name }}
                                @endforeach
                                </p>
                            </div>
                        </div>

                        <a class="btn btn-primary" href="/users">Back to users</a>
                        @if(Auth::user()->hasRole('admin'))
                            <a class="btn btn-success" href="/users/{{$user->id}}/edit">Edit user</a>
                            <form style="display: inline;" method="POST" action="/users/{{$user->id}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <input type="submit" value="Delete user" class="btn btn-danger">
                            </form>
                        @endif

                        @include('layouts.errors')
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3>Courses enrolled to</h3></div>
                            <div class="panel-body">
                                @if(!$user->enrolledCourses()->get()->isEmpty())
                                    <ul>
                                        @foreach($user->enrolledCourses()->get() as $course_user)
                                            <li>{{$course_user->title}}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <h4>No courses enrolled to</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection