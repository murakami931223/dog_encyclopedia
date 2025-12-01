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
            </div>
        </div>
        <div class="description-area">
            <p>{{ $dog -> description }}</p>
        </div>
    </div>
</div>
@endsection
