@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Create course</h1></div>

                    <div class="panel-body">
                        <form class="form-tasks" action="/courses" method="POST">
                            {{csrf_field()}}
                            <label for="taskTitle" >Course title</label>
                            <input type="text" id="taskTitle" class="form-control" placeholder="title" name="title" required autofocus>
                            <br>
                            <label for="taskBody" >Course description</label>
                            <textarea name="description" id="taskBody" class="form-control" cols="30" rows="5" placeholder="Description"></textarea>
                            <br>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Create course</button>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-success" href="/courses">Back to courses</a>
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection