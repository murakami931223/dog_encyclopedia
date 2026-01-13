@extends('layouts.app')

@section('content')
<div class="list-wrapper">
    @if (!empty($search['keyword']) || !empty($search_category_name))
    <div class="search-word">
        <p>
            @if (!empty($keyword) && !empty($search_category_name))
            {{ $keyword }}、{{ $search_category_name }}
            @elseif (!empty($keyword))
                {{ $keyword}}
            @elseif (!empty($search_category_name))
                {{ $search_category_name }}
            @endif
            の犬
        </p>
    </div>
    @endif
    <div class="padding-box">
        <div class="dog-list">
            @foreach ($dogs as $dog)
            <div class="dog-item">
                @auth
                    <div class="usually-article-favorite-box">
                        @if (!Auth::user() -> is_favorite($dog -> id))
                            <span class="favorite-judge">
                                <i class="far fa-heart favorite-toggle" data-dog-id="{{ $dog->id }}"></i>
                            </span>
                        @else
                            <span class="favorite-judge">
                                <i class="fas fa-heart favorite-toggle" data-dog-id="{{ $dog->id }}"></i>
                            </span>
                        @endif
                    </div>
                @endauth
                <a class="dog-article" href="{{ route('article', ['id' => $dog -> id]) }}">
                    <img src="{{ asset($dog->dog_img) }}">
                    <p class="dog-name">{{ $dog->dog_name }}</p>
                </a>
            </div>
            @endforeach
        </div>
        {{ $dogs->appends(request()->except('page'))->links('vendor.pagination.tailwind_custom') }}
    </div>
    </div>
@endsection
