@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Groups
                        @if(isset(request()->input()['page']))
                            - page {{ request()->input()['page'] }}
                        @endif
                    </h1></div>

                    <div class="panel-body">
                        <ul>
                        @foreach($groups as $group)
                            <li><a href="/groups/{{$group->id}}">{{$group->name}}</a> - {{$group->description}}</li>
                        @endforeach
                        </ul>
                        <div class="text-center">{{ $groups->links() }}</div>
                    </div>
                </div>
                <a class="btn btn-primary" href="/groups/create">Create new group</a>
            </div>
        </div>
    </div>

@endsection