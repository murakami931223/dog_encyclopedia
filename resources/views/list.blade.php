@extends('layouts.app')

@section('content')
<div class="list-wrapper">
    <div id="flash-message-container">
        @if (session('success'))
        <div id="flash-message" class="alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    @if (!empty($search['keyword']) || !empty($search_category_name))
    <div class="search-word">
        <p>
            @if (!empty($keyword) && !empty($search_category_name))
            {{ $keyword }}、{{ $search_category_name }}
            @elseif (!empty($keyword))
                {{ $keyword }}
            @elseif (!empty($search_category_name))
                {{ $search_category_name }}
            @endif
            の犬
        </p>
        <div class="sort-area">
            <select id="dog-sort-select">
                <option value="default">並び替え</option>
                <option value="viewCounts-desc">閲覧数が多い順</option>
            </select>
        </div>
        @if(auth()->user()?->is_admin)
            <a class="create-link admin-link" href="{{ route('admin.create') }}">記事を追加する</a>
        @endif
    </div>
    @endif
    <div class="padding-box">
        <div id="dog-container">
            @include('_list_items', ['dogs' => $dogs])
        </div>
    </div>
    </div>
@endsection
