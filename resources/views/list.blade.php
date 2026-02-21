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
    @if (filled($keyword) || filled($search_category_name))
    <div class="search-word">
        <p id="search-result-text">
            @if (!empty($keyword) && !empty($search_category_name))
            {{ $keyword }}、{{ $search_category_name }}
            @elseif (filled($keyword))
                {{ $keyword }}
            @elseif (filled($search_category_name))
                {{ $search_category_name }}
            @else
                全て
            @endif
            の犬
        </p>
        
        @if(auth()->user()?->is_admin)
            <a class="create-link admin-link" href="{{ route('admin.create') }}">記事を追加する</a>
        @endif
    </div>
    @endif
    
    @if ($dogs->isNotEmpty())
        <div class="sort-area">
            <select id="dog-sort-select">
                <option value="default">並び替え</option>
                <option value="viewCounts-desc">閲覧数が多い順</option>
            </select>
        </div>
        <div id="dog-container">
            @include('_list_items', ['dogs' => $dogs])
        </div>
    @else
        <div class="no-dogs">
            <p class="no-dogs-text">検索結果はありません。</p>
        </div>
    @endif
</div>
@endsection
