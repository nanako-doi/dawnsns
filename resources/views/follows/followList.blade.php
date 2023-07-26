@extends('layouts.login')

@section('content')

<body>
    <!-- フォローしているユーザーのリスト -->
    <div class = "follow_list">
    <h1>Follow List</h1>
        @foreach($users as $personal)
        @if($follows->contains('follower',$personal->id))
        <a href="/personal-profile/{{ $personal->id }}"><img src="/images/{{$personal->images}}"></a>
        @endif
        @endforeach
    </div>
    <div class = "follow_post">
        <table class='table table-hover'>
            @foreach ($posts as $post)
            @if($follows->contains('follower',$post->user_id))
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