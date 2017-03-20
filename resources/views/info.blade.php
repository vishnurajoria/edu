@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Info</h1></div>
            <div class="panel-body">
                @if($enabled)
                    <h3>Admin</h3>
                    <p><b>admin@admin.com</b> - 121212</p>
                    <h3>Teachers</h3>
                    <ul>
                        <li><b>teacher@teacher.com</b> - 121212</li>
                        @foreach(App\User::getByRole('teacher') as $user)
                            @if(Hash::check('secret',$user->password))
                                <li>{{ $user->email }} - secret</li>
                            @endif
                        @endforeach
                    </ul>
                    <h3>Students</h3>
                    <ul>
                        <li><b>student@student.com</b> - 121212</li>
                        @foreach(App\User::getByRole('student') as $user)
                            @if(Hash::check('secret',$user->password))
                                <li>{{ $user->email }} - secret</li>
                            @endif
                        @endforeach
                    </ul>
                    <h3>Editors</h3>
                    <ul>
                        @foreach(App\User::getByRole('editor') as $user)
                            @if(Hash::check('secret',$user->password))
                                <li>{{ $user->email }} - secret</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection