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

    <div class = "line"></div>

    <div class='timeline'>
      <table class='timeline_table'>
        @foreach ($posts as $post)
          <tr>
            <td class = img><a href="/personal-profile/{{ $post->user_id }}"><img src="/images/{{$post->images}}" style="border-radius: 50%;"></td>
            <th class = "username">{{ $post->username }}</th>
            <td class = "post">{{ $post->post }}</td>
            <th class = "created_at">{{ $post->created_at }}</th>
        @endforeach
        </table>
    </div>
</body>
</html>
</div>

@endsection