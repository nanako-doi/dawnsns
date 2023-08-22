@extends('layouts.login')
@section('content')

<body>
    <div class="UserProfile">
    <img src="storage/images/{{Auth::user()->images}}" style="border-radius: 50%;">
    {!! Form::open(['url' => '/profileup','files' => 'true']) !!}
    {!! Form::label('UserName') !!}
    {!! Form::input('text', 'up_username', Auth::user()->username , ['required', 'class' => 'form-control']) !!}</>
        @if($errors->has('up_username'))
        <div class="error"><p>{{ $errors->first('up_username') }}</p></div>
        @endif
    {!! Form::label('MailAdress') !!}
    {!! Form::input('email', 'up_mail', Auth::user()->mail , ['required', 'class' => 'form-control']) !!}</>
        @if($errors->has('up_mail'))
        <div class="error"><p>{{ $errors->first('up_mail') }}</p></div>
        @endif
    {!! Form::label('Password') !!}
    {!! Form::input('password', 'password', $passwordCount , ['required', 'class' => 'form-control' , 'readonly']) !!}</>
    {!! Form::label('new Password') !!}
    {!! Form::input('password', 'up_password', null , ['class' => 'form-control']) !!}</>
        @if($errors->has('up_password'))
        <div class="error"><p>{{ $errors->first('up_password') }}</p></div>
        @endif
    {!! Form::label('Bio') !!}
    {!! Form::input('text', 'up_bio', Auth::user()->bio , ['class' => 'form-control']) !!}</>
        @if($errors->has('up_bio'))
        <div class="error"><p>{{ $errors->first('up_bio') }}</p></div>
        @endif
    {!! Form::label('Icon image') !!}
    {!! Form::input('file', 'up_images', null , ['class' => 'form-control']) !!}</>
        @if($errors->has('up_images'))
        <div class="error"><p>{{ $errors->first('up_images') }}</p></div>
        @endif
    <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
    </div>
</body>
</html>
</div>

@endsection