@extends('layouts.app')

@section('title', __('static.forgot_password_title'))

@section('content')
<main class="desktop-20-main">
    <div class="desktop-twenty-main">
        <div class="container">
            <div class="desktop-twenty-wrpper">
                <h3>{{ __('static.forgot_password_heading') }}</h3>
                <h3>{{ __('static.forgot_password_help') }}</h3>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <label for="login">{{ __('static.email_or_phone') }}</label>
                    <input type="text" name="login" id="login" value="{{ old('login') }}" required autofocus>
                    <button type="submit">{{ __('static.send_reset_code') }}</button>

                    @error('login')
                        <p>{{ $message }}</p>
                    @enderror

                    @if(session('status'))
                        <p>{{ session('status') }}</p>
                    @endif
                </form>
                <p>
                    <a href="{{ route('register') }}">{{ __('static.create_new_account') }}</a>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
