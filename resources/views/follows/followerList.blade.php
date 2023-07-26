@extends('layouts.login')

@section('content')

<body>
    <!-- フォローされているユーザーのリスト -->
    <div class = "follower_list">
    <h1>Follower List</h1>
        @foreach($users as $personal)
        @if($followers->contains('follow',$personal->id))
        <a href="/personal-profile/{{ $personal->id }}"><img src="/images/{{$personal->images}}"></a>
        @endif
        @endforeach
    </div>
    <div class = "follower_post">
        <table class='table table-hover'>
            @foreach ($posts as $post)
            @if($followers->contains('follow',$post->user_id))
            <tr>
                <!-- 表示された$postsのuser_idと$usersのidが同じ$usersのimagesを表示させる -->
                <td><img src = "/images/dawn.png"></td>
                <td>{{ $post->post }}</td>
                <td>{{ $post->created_at }}</td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</body>

@endsection