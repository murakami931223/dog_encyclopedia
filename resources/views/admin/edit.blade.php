@extends('layouts.app')

@section('content')
<div class="edit-wrapper">
    <div id="flash-message-container">
        @if (session('success'))
        <div id="flash-message" class="alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="content-area">
        <p class="create-heading">記事更新</p>
        <form method="POST" action="{{ route('admin.update', ['id' => $dog -> id ]) }}"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="dog-name-container">
                @error('dogName')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                <label for="dog-name" class="create-label">犬の名前</label>
                <div class="dog-name-title create-refresh">
                    <input id="dog-name" type="text" class="create-input" name="dogName" value="{{ old('dogName', $dog->dog_name) }}">
                </div>
            </div>
            <div class="flex-content">
                <div class="img-container">
                    @error('dogImg')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                    <label for="dog-img" class="create-label">画像</label>
                    <div class="img-area">
                        <div class="preview-container" style="margin-bottom: 10px;">
                            <img id="preview" src="{{ $dog->dog_img ? asset($dog->dog_img) : '' }}" 
                                alt="" style="max-width: 200px; display: {{ $dog->dog_img ? 'block' : 'none' }};">
                        </div>

                        <input id="dog-img" type="file" class="create-file" name="dogImg" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>
                <div id="create-feature-area" class="feature-area">
                    <table class="feature-tb create-tb">
                        <tbody>
                            <tr>
                                @error('originId')
                                    <div style="color: red;">{{ $message }}</div>
                                @enderror
                                <th><label for="origin-id" class="create-tb-label">原産国</label></th>
                                <td>
                                    <select id="origin-id" class="create-select" name="originId" required>
                                        <option value="" hidden>選択してください</option>
                                        @foreach ($origins as $origin)
                                            <option value="{{ $origin->id }}" {{ old('originId', $dog->origin_id) == $origin->id ? 'selected' : ''}}>{{ $origin->country_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                @error('sizeId')
                                    <div style="color: red;">{{ $message }}</div>
                                @enderror
                                <th><label for="size-id" class="create-tb-label">サイズ</label></th>
                                <td>
                                    <select id="size-id" class="create-select" name="sizeId" required>
                                        <option value="" hidden>選択してください</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}" {{ old('sizeId', $dog->size_id) == $size->id ? 'selected' : ''}}>{{ $size->type }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="description-container">
                @error('description')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                <label for="description" class="create-label">説明文</label>
                <div class="admin-description-area">
                    <textarea id="description" class="create-input" name="description">{{ old('description', $dog->description) }}</textarea>
                </div>
            </div>

            <div class="create-btn-container">
                <input class="create-btn" type="submit" value = "更新" >
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result; // 読み込んだ画像をsrcに設定
                preview.style.display = 'block'; // 非表示だった画像を表示
            }
            
            reader.readAsDataURL(input.files[0]); // ファイルを読み込む
        }
    }
</script>
@endsection
