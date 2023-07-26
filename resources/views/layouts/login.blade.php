<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ページの内容を表す文章" />
    <title>DAWN SNS</title>
    <link rel='stylesheet' href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="{{ asset('images/main_logo.png') }}" sizes="16x16" type="image/png" />
    <link rel="icon" href="{{ asset('images/main_logo.png') }}" sizes="32x32" type="image/png" />
    <link rel="icon" href="{{ asset('images/main_logo.png') }}" sizes="48x48" type="image/png" />
    <link rel="icon" href="{{ asset('images/main_logo.png') }}" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/main_logo.png') }}" />
    <!--OGPタグ/twitterカード-->
    <script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js') }}"></script>
    <script src="{{ asset('./js/script.js') }}"></script>
    <script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js') }}"></script>

</head>
<body>
    <header>
        <div id = "head">
            <h1><a href="/top"><img src="{{ asset('images/main_logo.png') }}"></a></h1>
    </header>

    <div class="menu">
            <label for="menu_bar01">
                    <?php $user = Auth::user(); ?>{{ $user->username }}さん
                    <div class="arrow"></div>
                    <img src="{{ asset('images/dawn.png')}}">
            </label>
            <input type="checkbox" id="menu_bar01" class="accordion">
                 <ul id="links01">
                    <li><a href="/top">HOME</a></li>
                    <li><a href="/profile">プロフィール</a></li>
                    <li><a href="/logout">ログアウト</a></li>
            </ul>
    </div>

    <div id="row">
        <div id="container">
            @yield('content')
        </div >

        <div id="side-bar">
            <div id="confirm">
                <p><?php $user = Auth::user(); ?>{{ $user->username }}さんの</p>
                <div>
                <p>フォロー数</p>
                <p><?php $follow_counts = DB::table('follows')->where('follow',Auth::user()->id)->count(); ?>{{ $follow_counts }}名</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <p><?php $follower_counts = DB::table('follows')->where('follower',Auth::user()->id)->count(); ?>{{ $follower_counts }}名</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>