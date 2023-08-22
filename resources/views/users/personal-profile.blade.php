@extends('layouts.login')
@section('content')

<body>
    <div class="personal-profile">
        <img src="/images/{{$users->images}}">
        <div class = 'profile-box'>
            <p class = title>Name</p>
            <p>{{$users->username}}</p>
            <p class = title>Bio</p>
            <p>{{$users->bio}}</p>
        </div>
            @if($follows->contains('follower',$users->id))
            <a class="btn btn-primary" href="/personalunfollow/{{ $users->id }}" style="background-color: #b95656;">フォロー解除</a>
            @else
            <a class="btn btn-primary" href="/personalfollow/{{ $users->id }}" style="background-color: #4b71Ca;">フォローする</a>
            @endif
    </div>
    <div class = "line"></div>
    <div class='timeline'>
        <table class='timeline_table'>
        @foreach ($posts as $post)
        <tr>
            <td class = img><img src="{{ asset('storage/images/'.$users->images)}}" style="border-radius: 50%;"></td>
            <td class = username>{{ $users->username }}</td>
            <td class = post>{{ $post->post }}</td>
            <td class = created_at>{{ $post->created_at }}</td>
        </tr>
        @endforeach
        </table>
    </div>
</body>
</html>
</div>

@endsection