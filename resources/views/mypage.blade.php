@extends('layouts.app')

@section('content')
<div class="mypage-wrapper">
    <div class="mypage-content">
        <div class="user-info">
            <p class="user-info-heading">マイページ</p>
            <div class="user-info-table">
                <table>
                    <tbody>
                        <tr>
                            <th>氏名：</th>
                            <td><p class="user-name">{{ $user->name }}</p></td>
                        </tr>
                        <tr>
                            <th>Email：</th>
                            <td><p class="user-email">{{ $user->email }}</p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @auth
                @if ($user->is_admin)
                    <div class="empowerment-toggle">
                        <p data-user_id="{{ $user->id }}" class="empowerment-btn release-btn" >編集権限を解除しますか？</p>
                    </div>
                @else
                    <div class="empowerment-toggle">
                        <p data-user_id="{{ $user->id }}" class="empowerment-btn grant-btn" >編集権限を付与しますか？</p>
                    </div>
                @endif
            @endauth
        </div>
        <div class="favorite-dogs-list">
            <p class="list-heading">お気に入りリスト</p>
            <div id="favorite-items-container">
                @forelse ($favorites as $favorite)
                    <div class="favorite-dog-item">
                        <div class="favorite-dog-link">
                            <a class="favorite-dog-article" href="{{ route('article', ['id' => $favorite->dog_id]) }}">
                                <img src="{{ $favorite->dog->getDogImageUrl() }}" alt="{{ $favorite->dog_name }}の画像">
                            </a>
                            <div class="favorite-dog-info">
                                <p class="favorite-dog-name">{{ $favorite->dog->dog_name }}</p>
                                <table class="favorite-dog-feature-tb">
                                    <tbody>
                                        <tr>
                                            <th>原産国</th>
                                            <td>{{ $favorite->dog->origin->country_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>サイズ</th>
                                            <td>{{ $favorite->dog->size->type }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @auth
                        <div class="article-favorite-box responsive-favorite-box">
                            @if (Auth::user() -> is_favorite($favorite->dog_id))
                                <span class="favorite-judge">
                                    <i class="fas fa-heart favorite-toggle" data-dog_id="{{ $favorite->dog_id }}"></i>
                                </span>
                            @endif
                        </div>
                        @endauth
                    </div>
                @empty
                    <p class="favorite-none">お気に入りはありません。</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
