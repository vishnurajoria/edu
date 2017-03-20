@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Your Groups</h1></div>

                    <div class="panel-body">
                        @foreach($groups as $group)
                            <li><a href="/groups/{{$group->id}}">{{$group->name}}</a> - {{$group->description}}</li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection