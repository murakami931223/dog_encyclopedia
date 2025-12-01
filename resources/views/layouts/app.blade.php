<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/more_list.js') }}"></script>

    <!-- Style --> 
    <link rel="stylesheet" href="https://unpkg.com/destyle.css@3.0.2/destyle.min.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body class="route-{{ Route::currentRouteName() }}">
    <div id="app">
        <header class="main-header">
            <div class="header-container">
                <a class="header-logo" href="{{ url('/') }}">
                    {{ config('app.name', '犬図鑑') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @unless (Route::is('login') || Route::is('register'))
                <div class="search-bar">
                    <form action="{{ route('list') }}" method="GET">
                    @csrf
                    <div class="category-search">
                        <select class="select-area" name="category_id">
                            <option value="" {{ $currentCategory == '' ? 'selected' : '' }}>全て</option>
                            <option style="font-weight: bold;">--犬種--</option>
                            @foreach ($sizes as $size)
                            <option value="s_{{ $size->id }}" {{ $currentCategory == 's_' . $size->id ? 'selected' : '' }}>{{ $size->type }}</option>
                            @endforeach
                            <option style="font-weight: bold;">--原産国--</option>
                            @foreach ($origins as $origin)
                            <option value="o_{{ $origin->id }}" {{ $currentCategory == 'o_' . $origin->id ? 'selected' : '' }}>{{ $origin->country_name }}</option>
                            @endforeach
                        </select>
                    </div>
                        <input class="input-area" type="text" name="keyword" value="{{ request('keyword', $currentKeyword) }}"  placeholder="キーワードを入力してください">
                        <button class="search-btn" type="submit">
                            検索
                        </button>
                    </form>
                </div>
                @endunless

                <div class="navbar-container" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav-list ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="menu menu-end" aria-labelledby="navbarDropdown">
                                    <a class="drop-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </header>

        <main class="main-content">
            @yield('content')
        </main>

        <footer class="main-footer">
            <div class="footer-p">
                <p>趣味サイト</p>
            </div>
        </footer>
    </div>
</body>
</html>
