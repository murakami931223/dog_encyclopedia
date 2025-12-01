@extends('layouts.app')

@section('content')
    <!-- トップ画像 -->
    <div class="title-area">
        <p class="main-title">犬図鑑</p>
        <p class="sub-title">趣味制作サイト</p>
    </div>
    <div class="top-wrapper">
        <!-- 犬種カテゴリー -->
        <div class="category-wrapper">
            <div class="category-position">
                <p class="category-heading">カテゴリー</p>
                <div class="dog-type">
                    <div class="small-dog type-item">
                        <a class="type-search" href = "{{ route('list', ['category_id' => 's_1']) }}">
                            <img src="{{ asset('icon-etc/小型犬.png') }}" alt="アイコン">
                        </a>
                    </div>
                    <div class="middle-dog type-item">
                        <a class="type-search" href = "{{ route('list', ['category_id' => 's_2']) }}">
                            <img src="{{ asset('icon-etc/中型犬.png') }}" alt="アイコン">
                        </a>
                    </div>
                    <div class="big-dog type-item">
                        <a class="type-search" href = "{{ route('list', ['category_id' => 's_3']) }}">
                            <img src="{{ asset('icon-etc/大型犬.png') }}" alt="アイコン">
                        </a>
                    </div>
                </div>
            <hr class="category-hr">
                <!-- 原産国カテゴリー -->
                <div class="dog-origin">
                    <div class="japan-dog origin-item">
                        <a class="origin-search" href = "{{ route('list', ['category_id' => 'o_1']) }}">
                            <img src="{{ asset('icon-etc/japan.png') }}" alt="アイコン">
                            <p class="origin-text">日本原産</p>
                        </a>
                    </div>
                    <div class="american-dog origin-item">
                        <a class="origin-search" href = "{{ route('list', ['category_id' => 'o_2']) }}">
                            <img src="{{ asset('icon-etc/America.png') }}" alt="アイコン">
                            <p class="origin-text">アメリカ原産</p>
                        </a>
                    </div>
                    <div class="china-dog origin-item">
                        <a class="origin-search" href = "{{ route('list', ['category_id' => 'o_3']) }}">
                            <img src="{{ asset('icon-etc/china.png') }}" alt="アイコン">
                            <p class="origin-text">中国原産</p>
                        </a>
                    </div>
                    <div class="german-dog origin-item">
                        <a class="origin-search" href = "{{ route('list', ['category_id' => 'o_4']) }}">
                            <img src="{{ asset('icon-etc/german.png') }}" alt="アイコン">
                            <p class="origin-text">ドイツ原産</p>
                        </a>
                    </div>
                    <div class="UK-dog origin-item">
                        <a class="origin-search" href = "{{ route('list', ['category_id' => 'o_5']) }}">
                            <img src="{{ asset('icon-etc/UK.png') }}" alt="アイコン">
                            <p class="origin-text">イギリス原産</p>
                        </a>
                    </div>
                    <div class="france-dog origin-item">
                        <a class="origin-search" href = "{{ route('list', ['category_id' => 'o_6']) }}">
                            <img src="{{ asset('icon-etc/france.png') }}" alt="アイコン">
                            <p class="origin-text">フランス原産</p>
                        </a>
                    </div>
                    <div class="russia-dog origin-item">
                        <a class="origin-search" href = "{{ route('list', ['category_id' => 'o_7']) }}">
                            <img src="{{ asset('icon-etc/russia.png') }}" alt="アイコン">
                            <p class="origin-text">ロシア原産</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="display-switching" class="list-wrapper">
            <p class="list-heading">一覧</p>
            <div class="dog-list">
                @foreach ($dogs as $dog)
                <div class="dog-item">
                    <a class="dog-article" href="{{ route('article', ['id' => $dog -> id]) }}">
                        <img src="{{ asset($dog->dog_img) }}">
                        <p class="dog-name">{{ $dog->dog_name }}</p>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="btn-area">
                <p id="more-btn">もっと見る...</p>
                <p id="close-btn">折りたたむ</p>
            </div>
        </div>
    </div>
@endsection
