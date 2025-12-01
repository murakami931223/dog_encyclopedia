@extends('layouts.app')

@section('content')
<div class="login-wrapper">
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mail-container">
                    <div class="form-row form-margin-bottom">
                        <label for="email" class="form-label">メールアドレス</label>
    
                            <div class="login-input-area">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                    </div>
                    
                    @error('email')
                    <div class="form-row">
                        <div class="form-label"></div>
                        <div class="error-message">
                            <span class="invalid-feedback" role="alert">
                                <strong>メールアドレスが一致しません。</strong>
                            </span>
                        </div>
                    </div>
                    @enderror
                </div>

                <div class="password-container">
                    <div class="form-row">
                        <label for="password" class="form-label">パスワード</label>
    
                        <div class="login-input-area">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                    </div>
                    @error('password')
                    <div class="form-row">
                        <div class="form-label"></div>
                        <div class="error-message">
                            <span class="invalid-feedback" role="alert">
                                <strong>パスワードが一致しません。</strong>
                            </span>
                        </div>
                    </div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-label"></div>
                    <div class="support-area">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                            <label class="form-check-label" for="remember">
                                ログイン情報を記憶する
                            </label>
                        </div>
    
                        <div class="forget-password">
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                パスワードを忘れましたか？
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-row form-flex-end">
                    <div class="login-btn-area">
                        <button type="submit" class="login-btn">
                            ログイン
                        </button>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection
