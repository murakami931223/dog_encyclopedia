@extends('layouts.app')

@section('content')
<div class="article-wrapper">
    <div id="flash-message-container">
        @if (session('success'))
        <div id="flash-message" class="alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="content-area">
        <div class="dog-name-title">
            <p>{{ $dog->dog_name }}</p>
            <div class="edit-delete-area">
                @if(auth()->user()?->is_admin)
                    <a class="edit-link admin-link" href="{{ route('admin.edit', ['id' => $dog -> id ]) }}">記事を編集する</a>
                    <div class="delete-area">
                        <form action="{{ route('admin.delete', ['id' => $dog -> id ]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('delete')
                            <input class="article-delete-btn delete-btn-primary" type="submit" value = "削除" >
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex-content">
            <div class="img-area">
                <img src="{{ $dog->getDogImageUrl() }}" alt="{{ $dog->dog_name }}の画像">
            </div>
            <div class="feature-area">
                <table class="feature-tb">
                    <tbody>
                        <tr>
                            <th>原産国</th>
                            <td>{{ $dog -> origin -> country_name }}</td>
                        </tr>
                        <tr>
                            <th>サイズ</th>
                            <td>{{ $dog -> size -> type }}</td>
                        </tr>
                    </tbody>
                </table>
                @auth
                <div class="article-favorite-box">
                    @if (!Auth::user() -> is_favorite($dog -> id))
                        <span class="favorite-judge">
                            <i class="far fa-heart favorite-toggle" data-dog_id="{{ $dog->id }}"></i>
                        </span>
                    @else
                        <span class="favorite-judge">
                            <i class="fas fa-heart favorite-toggle" data-dog_id="{{ $dog->id }}"></i>
                        </span>
                    @endif
                </div>
                @endauth
            </div>
        </div>
        <div class="description-area">
            <p>{{ $dog -> description }}</p>
        </div>
    </div>
</div>
@endsection
