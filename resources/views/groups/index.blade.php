@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Groups</h1></div>

                    <div class="panel-body">
                        @foreach($groups as $group)
                            <li><a href="/groups/{{$group->id}}">{{$group->name}}</a> - {{$group->description}}</li>
                        @endforeach
                    </div>
                </div>
                <a class="btn btn-primary" href="/groups/create">Create new group</a>
            </div>
        </div>
    </div>

@endsection