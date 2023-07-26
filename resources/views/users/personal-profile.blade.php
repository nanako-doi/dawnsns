@extends('layouts.login')
@section('content')

<body>
    <div class="personal-profile">
        <img src="/images/{{$users->images}}">
        <p>Name {{$users->username}}</p>
        <p>Bio {{$users->bio}}</p>

        @if($follows->contains('follower',$users->id))
        <a class="btn btn-primary" href="/personalunfollow/{{ $users->id }}" style="background-color: #b95656;">フォロー解除</a>
        @else
        <a class="btn btn-primary" href="/personalfollow/{{ $users->id }}" style="background-color: #4b71Ca;">フォローする</a>
        @endif

    </div>

    <div class="personal-post">
        <table class='table table-hover'>
            @foreach ($posts as $post)
            <tr>
                <td><img src="{{ asset('images/dawn.png') }}"></td>
                <td>{{ $post->post }}</td>
                <td>{{ $post->created_at }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

@endsection