@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="reset-explanation">
        <div class="card-header">パスワードリセット</div>
        <p>メールアドレスを入力すると、そのアドレス宛にパスワードリセット用メールを送ります。</p>
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

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

            <div class="form-row form-flex-end">
                <div class="btn-area">
                    <button type="submit" class="sendEmail-btn auth-btn-primary">
                        メール送信
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
