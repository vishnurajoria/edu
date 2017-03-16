@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Update course: {{$course->title}}</h1></div>

                    <div class="panel-body">
                        <form class="form-tasks" action="/courses/{{$course->id}}" method="POST">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <label for="courseTitle">Course name</label>
                            <input type="text" id="courseTitle" class="form-control" placeholder="Title" name="title" value="{{$course->title}}" required autofocus>
                            <br>
                            <label for="courseDescription">Course description</label>
                            <textarea name="description" id="courseDescription" class="form-control" cols="30" rows="3" placeholder="Description" >{{$course->description}}</textarea>
                            <br>
                            <button class="btn btn-lg btn-success btn-block" type="submit">Update course</button>
                        </form>
                    </div>
                </div>
                <a class="btn btn-sm btn-primary" href="/courses">Back to courses</a>
                @include('layouts.errors')
            </div>
        </div>
    </div>

@endsection