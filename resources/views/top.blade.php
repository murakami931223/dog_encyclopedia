@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title">
        <h1>犬リスト</h1>
    </div>
    @foreach ($dogs as $dog)
    <div class="dog-list">
        <div class="item">
            <img src="{{ asset($dog->dog_img) }}">
            <p class="dog-name">{{ $dog->dog_name }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection
