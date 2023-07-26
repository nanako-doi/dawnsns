@extends('layouts.login')

@section('content')

  <body>
      <div class="user_post">
        <img src="images/dawn.png" style="border-radius: 50%;">
        {!! Form::open(['url' => '/top']) !!}
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => 'なにをつぶやこうかなあ']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right"><img src="images/post.png"></button>
        {!! Form::close() !!}
      </div>

      <div class='container'>

      <table class='table table-hover'>
          @foreach ($posts as $post)
          @if($follows->contains('follower',$post->user_id))
          <tr>
            <td><img src = "/images/dawn.png" style="border-radius: 50%;"></td>
            <td>{{ $post->post }}</td>
            <td>{{ $post->created_at }}</td>

            <!-- if ログインユーザーのidが$postのuser_idにあれば編集・削除ボタンを表示させる。 -->
            <td><button class="modal-open" data-target="js-modal"><img src="images/edit.png"></button></td>
              <!-- モーダル -->
              <td class="modal-main" id="js-modal">
              <div class="modal-inner">
              <div class="inner-content">
                {!! Form::open(['url' => '/post/{id}/update']) !!}
                {!! Form::hidden('id', $post->id) !!}</>
                {!! Form::input('text', 'upPost', $post->post, ['required', 'class' => 'form-control']) !!}</>
                <button type="submit" class="send-button update">更新</button>
                {!! Form::close() !!}
                <a class="send-button modalClose">キャンセル</a>
              </div>
              </div>
              </td>
            <td>
              <a class="delete-button" href="/post/{{ $post->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
              <img src="images/trash.png" onmouseover="this.src='images/trash_h.png'" onmouseout="this.src='images/trash.png'">
              </a>
            </td>
          </tr>
            @endif
            @endforeach
        </table>
      </div>

  </body>
</html>
</div>

@endsection