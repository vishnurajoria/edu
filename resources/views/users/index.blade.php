@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Users
                        @if(isset(request()->input()['page']))
                            - page {{ request()->input()['page'] }}
                        @endif
                    </h1></div>

                    <div class="panel-body">
                        <ul>
                        @foreach($users as $user)
                            <li><a href="/users/{{$user->id}}">{{$user->name}}</a> -
                                @foreach($user->getRoles() as $role)
                                    {{$role->name}}
                                @endforeach
                            </li>
                        @endforeach
                        </ul>
                        <div class="text-center">{{ $users->links() }}</div>
                    </div>
                </div>
                <a class="btn btn-primary" href="/users/create">Create new user</a>
            </div>
        </div>
    </div>

@endsection