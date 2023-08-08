@extends('layouts.login')

@section('content')
<body>
<div id="search-form">
<form action="{{ url('/search-result')}}" method="post">
    {{ csrf_field()}}
    {{method_field('get')}}
        <input type="text" class="form-control col-md-5" placeholder="ユーザー名" name="username">
        <button type="submit" class="btn btn-primary col-md-5" style="background-color: #3C4767;">検索</button>
</form>
</div>

<div class = "line"></div>

<div id="user-list">
<table class="user-table">
@foreach($users as $personal)
<tr>
  <td class = image><img src="/images/{{$personal->images}}" style="border-radius: 50%;"></td>
  <td class = username>{{$personal->username}}</td>
  <td>
    @if($follows->contains('follower',$personal->id))
      <a class="btn btn-primary" href="/unfollow/{{ $personal->id }}" style="background-color: #b95656;">フォロー解除</a>
    @else
      <a class="btn btn-primary" href="/follow/{{ $personal->id }}" style="background-color: #4b71Ca;">フォローする</a>
    @endif
  </td>
<tr>
@endforeach
</table>
</div>

</body>
</html>
</div>
@endsection