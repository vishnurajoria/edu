@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Create role</h1></div>

                    <div class="panel-body">
                        <form class="form-tasks" action="/roles" method="POST">
                            {{csrf_field()}}
                            <label for="roleName">Role name</label>
                            <input type="text" id="roleName" class="form-control" placeholder="Name" name="name" required autofocus>
                            <br>
                            <label for="roleLabel">Role label</label>
                            <textarea name="label" id="roleLabel" class="form-control" cols="30" rows="3" placeholder="Label"></textarea>
                            <br>
                            <label>Role permissions</label>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    @foreach($all_permissions as $permission)
                                        <input type="checkbox" name="permissions[]" id="{{$permission->name}}" value="{{$permission->name}}">
                                        <label for="{{$permission->name}}">{{$permission->label}}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Create role</button>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-success" href="/roles">Back to roles</a>
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection