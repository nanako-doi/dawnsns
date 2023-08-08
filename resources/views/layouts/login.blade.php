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
    <script src="{{ asset('https://code.jquery.com/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('./js/script.js') }}"></script>
    <script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js') }}"></script>

</head>
<body>
    <header>
        <div id = "head">
            <h1><a href="/top"><img src="{{ asset('images/main_logo.png') }}"></a></h1>
            <h2><img src="{{ asset('storage/images/'.Auth::user()->images)}}"><h2>

        <div id="accordion" class="accordion-container">
        <h3 class="accordion-title js-accordion-title"> <?php $user = Auth::user(); ?>{{ $user->username }} さん </h3>
            <div class="accordion-content">
            <ul id="links">
                <li><a href="/top">HOME</a></li>
                <li><a href="/profile">プロフィール</a></li>
                <li><a href="/logout">ログアウト</a></li>
            </ul>
            </div>
        </div>

</header>

    <div id="row">
        <div id="container">
            @yield('content')
            <div id="side-bar">
            <div id="confirm">
                <p class = "left-title"><?php $user = Auth::user(); ?>{{ $user->username }}さんの</p>
                <div>
                <p class = "left-title">フォロー数</p>
                <p><?php $follow_counts = DB::table('follows')->where('follow',Auth::user()->id)->count(); ?>{{ $follow_counts }}名</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div>
                <p class = "left-title">フォロワー数</p>
                <p><?php $follower_counts = DB::table('follows')->where('follower',Auth::user()->id)->count(); ?>{{ $follower_counts }}名</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <div class = "line"></div>
            <div id="search-btn">
            <p class="btn"><a href="/search">ユーザー検索</a></p>
            </div>
        </div>
        </div>


    </div>

    <footer>
    </footer>
</body>
</html>