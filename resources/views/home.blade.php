@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="links">
                        <a href="/tasks">Tasks</a>
                        <a href="/courses">Courses</a>
                        @if(Auth::user()->hasRole('admin'))
                            <a href="/roles"><b>Manage Roles</b></a>
                            <a href="/groups"><b>Manage Groups</b></a>
                            <a href="/users"><b>Manage Users</b></a>
                        @endif
                        @if(Auth::user()->hasRole('student') || Auth::user()->hasRole('teacher'))
                            <a href="/your-groups"><b>Groups</b></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
