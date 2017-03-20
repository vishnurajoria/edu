@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Users</h1></div>

                    <div class="panel-body">
                        @foreach($users as $user)
                            <li><a href="/users/{{$user->id}}">{{$user->name}}</a> -
                                @foreach($user->getRoles() as $role)
                                    {{$role->name}}
                                @endforeach
                            </li>
                        @endforeach
                    </div>
                </div>
                <a class="btn btn-primary" href="/users/create">Create new user</a>
            </div>
        </div>
    </div>

@endsection