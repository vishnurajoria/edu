@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles</div>

                    <div class="panel-body">
                        @foreach($roles as $role)
                            <li><a href="/roles/{{$role->id}}">{{$role->name}}</a> - {{$role->label}}</li>
                        @endforeach
                    </div>
                </div>
                <a class="btn btn-primary" href="/roles/create">Create new role</a>
            </div>
        </div>
    </div>

@endsection