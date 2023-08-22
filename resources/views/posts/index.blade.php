@extends('layouts.login')
@section('content')

<body>
  <div class="user_post">
    <img src="storage/images/{{Auth::user()->images}}" style="border-radius: 50%; margin-right: 10px;">
    {!! Form::open(['url' => '/top']) !!}
    <div class="form-group">
    {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => 'なにをつぶやこうかなあ']) !!}
      @if($errors->has('newPost'))
      <div class="error"><p>{{ $errors->first('newPost') }}</p></div>
      @endif
    </div>
    <button type="submit" class="post-button pull-right"><img src="images/post.png"></button>
    {!! Form::close() !!}
  </div>
  <div class = "line"></div>
  <div class='timeline'>
    <table class='timeline_table'>
    @foreach ($posts as $post)
    <tr>
      <td class = img><img src="/images/{{$post->images}}" style="border-radius: 50%;"></td>
      <td class = username>{{ $post->username }}</td>
      <td class = post>{{ $post->post }}</td>
      <td class = created_at>{{ $post->created_at }}</td>
        @if($post->user_id === Auth::user()->id)
        <td><button class="modal-open" data-target="{{$post->id}}"><img src="images/edit.png"></button></td>
          <div class="modal-main js-modal" id="{{$post->id}}">
          <div class="modal-overlay js-modal-close"></div>
            <div class="modal-inner">
            <div class="inner-content">
            {!! Form::open(['url' => '/post/{id}/update']) !!}
            {!! Form::hidden('id', $post->id) !!}</>
            {!! Form::input('text', 'upPost', $post->post, ['required', 'class' => 'form-control']) !!}</>
              @if($errors->has('upPost'))
              <div class="error"><p>{{ $errors->first('upPost') }}</p></div>
              @endif
            <button type="submit" class="send-button update"><img src="images/edit.png"></button>
            {!! Form::close() !!}
            </div>
            </div>
          </div>
        <td>
        <a class="delete-button" href="/post/{{ $post->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
        <img src="images/trash.png" onmouseover="this.src='images/trash_h.png'" onmouseout="this.src='images/trash.png'">
        </a>
        </td>
        @endif
    </tr>
      @endforeach
    </table>
  </div>
</body>
</html>
</div>

@endsection