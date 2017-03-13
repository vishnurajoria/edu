@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{$role->name}}</h1></div>

                    <div class="panel-body">
                        <p>Description: {{$role->label}}</p>
                    </div>
                </div>
                <label>Role permissions</label>
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(!$role_permissions->isEmpty())
                            <ul>
                            @foreach($role_permissions as $permission)
                                <li>{{$permission->label}}</li>
                            @endforeach
                            </ul>
                        @else
                        <h3>No permissions</h3>
                        @endif
                    </div>
                </div>
                <form method="POST" action="/roles/{{$role->id}}">
                    {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    <a class="btn btn-primary" href="/roles">Back to roles</a>
                    <a class="btn btn-success" href="/roles/{{$role->id}}/edit">Edit role</a>
                    <input type="submit" value="Delete role" class="btn btn-danger"
                       @if($role->name === 'admin')
                       disabled
                        @endif
                    >
                </form>

                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection