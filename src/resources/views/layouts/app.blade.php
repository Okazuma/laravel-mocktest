<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <style>
    svg.w-5.h-5 {
        /*paginateメソッドの矢印の大きさ調整のために追加*/
        width: 30px;
        height: 30px;
    }
</style>
</head>

<body>


    <header>
        <div class="header">
            <div class="header__inner">
                <div class="header__logo">
                    <h1 class="header__ttl">Atte</h1>
                </div>
                @if (Auth::check())
                <nav class="header__nav">
                    <ul class="header__ul">
                        <li class="header__li">
                            <a class="header__link-button" href="/">ホーム</a>
                        </li>
                        <li class="header__li">
                            <a class="header__link-button" href="/attendance">日付一覧</a>
                        </li>


                        <li class="header__li">
                            <form class="header__button" action="/logout" method="post">
                            @csrf
                                <button class="header__link-button-logout" type="submit">
                                ログアウト
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    </header>


    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <span class="footer__logo">Atte,inc</span>
    </footer>

</body>
</html>