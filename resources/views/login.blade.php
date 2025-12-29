@extends('layouts.app')

@section('title', 'Welcome To Shaheq - ' . __('static.login_title'))

@section('content')
<main>
    <section id="desktop-seventen" class="booking-confirmation-area">
        <div class="container">
            <div class="booking-confirmation-wrpper desktop-nineten">
                <h3>{{ __('static.login_title') }}</h3>

                <!-- Laravel Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-row">
                        <label for="email">{{ __('static.email') }}</label>
                        <div class="form-group">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="{{ __('static.email_placeholder') }}"
                                value="{{ old('email') }}"
                                required autofocus
                            />
                            @error('email')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-row">
                        <label for="password">{{ __('static.password') }}</label>
                        <div class="form-group">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="********"
                                required
                            />
                            @error('password')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="confirm-box">
                        <a href="{{ route('password.request') }}">{{ __('static.forgot_password') }}</a>
                    </div>

                    <div class="form-submit text-center">
                        <button type="submit">{{ __('static.login_button') }}</button>
                    </div>
                </form>

                <p class="form-bottom">
                    {{ __('static.no_account') }}
                    <a href="{{ route('register') }}">{{ __('static.create_account') }}</a>
                </p>
            </div>
        </div>
    </section>
</main>
@endsection
