@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="name-container">
                <div class="form-row form-margin-bottom">
                    <label for="name" class="form-label">氏名</label>
    
                    <div class="register-input-area">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                </div>

                @error('name')
                <div class="form-row">
                    <div class="form-label"></div>
                    <div class="error-message">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    </div>
                </div>
                @enderror
            </div>

            <div class="mail-container">
                <div class="form-row form-margin-bottom">
                    <label for="email" class="form-label">メールアドレス</label>

                    <div class="register-input-area">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                </div>

                @error('email')
                <div class="form-row">
                    <div class="form-label"></div>
                    <div class="error-message">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                </div>
                @enderror
            </div>

            <div class="password-container">
                <div class="form-row form-margin-bottom">
                    <label for="password" class="form-label">パスワード</label>

                    <div class="register-input-area">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                </div>

                @error('password')
                <div class="form-row">
                    <div class="form-label"></div>
                    <div class="error-message">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                </div>
                @enderror
            </div>

            <div class="password-confirm-container">
                <div class="form-row form-margin-bottom">
                    <label for="password-confirm" class="form-label">パスワード確認</label>
    
                    <div class="register-input-area">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>

            <div class="form-row form-flex-end">
                <div class="btn-area">
                    <button type="submit" class="register-btn auth-btn-primary">
                        新規登録
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
