@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Create task</h1></div>

                    <div class="panel-body">
                        <form class="form-tasks" action="/tasks" method="POST">
                            {{csrf_field()}}
                            <label for="taskTitle" class="sr-only">Task title</label>
                            <input type="text" id="taskTitle" class="form-control" placeholder="title" name="title" required autofocus>
                            <br>
                            <label for="taskBody" class="sr-only">Task body</label>
                            <textarea name="body" id="taskBody" class="form-control" cols="30" rows="5" placeholder="Description"></textarea>
                            <br>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-success" href="/tasks">Back to tasks</a>
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection