@extends('layouts.login')
@section('content')
<body>
    <div class="UserProfile">
    {!! Form::open(['url' => '/profileup']) !!}
    <img src="images/dawn.png"style="border-radius: 50%;">
    <p>UserName</p>
    <input type="text" name="up_username" style="width:100%; height:50px;" value="{{ Auth::user()->username }}">
    <p>MailAdress</p>
    <input type="email" name="up_mail" style="width:100%; height:50px;" value="{{ Auth::user()->mail }}">
    <p>Password</p>
    <input type="password" name="password" style="width:100%; height:50px;" value="{{Session('password')}}">
    <p>new Password</p>
    <input type="password" name="up_password" style="width:100%; height:50px;" >
    <p>Bio</p>
    <input type="text" name="up_bio" style="width:100%; height:50px;" value="{{ Auth::user()->bio }}">
    <p>Icon image</p>
    <input type="file" name="up_images"style="width:100%; height:50px;">

    <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
    </div>

</body>

@endsection