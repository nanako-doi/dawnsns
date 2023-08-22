@extends('layouts.login')
@section('content')

<body>
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
      <td class = "username">{{ $post->username }}</td>
      <td class = "post">{{ $post->post }}</td>
      <td class = "created_at">{{ $post->created_at }}</td>
    </tr>
    @endforeach
    </table>
  </div>
</body>
</html>
</div>

@endsection