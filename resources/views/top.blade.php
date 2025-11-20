@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title">
        <h1>犬リスト</h1>
    </div>

    <ul class="dog-type">
        <li class="small-dog">
            <img src="{{ asset('icon-etc/小型犬.png') }}" alt="アイコン">
        </li>
    </ul>

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
