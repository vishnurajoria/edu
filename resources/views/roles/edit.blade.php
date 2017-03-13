@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Update role: {{$role->name}}</h1></div>

                    <div class="panel-body">
                        <form class="form-tasks" action="/roles/{{$role->id}}" method="POST">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <label for="roleName">Role name</label>
                            <input type="text" id="roleName" class="form-control" placeholder="Name" name="name" value="{{$role->name}}" required autofocus
                                @if($role->name === 'admin')
                                disabled
                                @endif
                            >
                            <br>
                            <label for="roleLabel">Role label</label>
                            <textarea name="label" id="roleLabel" class="form-control" cols="30" rows="3" placeholder="Label" >{{$role->label}}</textarea>
                            <br>
                            <label>Role permissions</label>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    @foreach($role_permissions as $permission)
                                        <input type="checkbox" name="permissions[]" id="{{$permission->name}}" value="{{$permission->name}}"
                                            @if($current_permissions->where('name', $permission->name)->first() && $current_permissions->where('name', $permission->name)->first()->name === $permission->name)
                                                checked
                                            @endif
                                        >
                                        <label for="{{$permission->name}}">{{$permission->label}}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit">Update role</button>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-primary" href="/roles">Back to roles</a>
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection