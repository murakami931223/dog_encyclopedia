@extends('layouts.app')

@section('content')
<div class="article-wrapper">
    <div class="content-area">
        <div class="dog-name-title">
            <p>{{ $dog->dog_name }}</p>
        </div>
        <div class="flex-content">
            <div class="img-area">
                <img src = "{{ asset($dog->dog_img) }}">
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
                            <i class="far fa-heart favorite-toggle" data-dog-id="{{ $dog->id }}"></i>
                        </span>
                    @else
                        <span class="favorite-judge">
                            <i class="fas fa-heart favorite-toggle liked" data-dog-id="{{ $dog->id }}"></i>
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
