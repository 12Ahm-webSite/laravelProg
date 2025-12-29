@extends('layouts.app')

@section('title', 'Welcome To Shaheq - ' . __('static.register_title'))

@section('content')
<main>
    <section id="desktop-seventen" class="booking-confirmation-area">
        <div class="container">
            <div class="booking-confirmation-wrpper">
                <h3>{{ __('static.register_title') }}</h3>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="input-row">
                        <label for="name">{{ __('static.full_name') }}</label>
                        <input type="text" id="name" name="name" placeholder="{{ __('static.full_name_placeholder') }}" value="{{ old('name') }}" required />
                        @error('name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-row">
                        <label for="email">{{ __('static.email') }}</label>
                        <input type="email" id="email" name="email" placeholder="{{ __('static.email_placeholder') }}" value="{{ old('email') }}" required />
                        @error('email')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-row">
                        <label for="phone">{{ __('static.phone_number') }}</label>
                        <input type="text" id="phone" name="phone" placeholder="{{ __('static.phone_placeholder') }}" value="{{ old('phone') }}" />
                        @error('phone')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-row">
                        <label for="password">{{ __('static.password') }}</label>
                        <input type="password" id="password" name="password" placeholder="********" required />
                        @error('password')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-row">
                        <label for="password_confirmation">{{ __('static.confirm_password') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="********" required />
                    </div>

                    <div class="input-row">
                        <label for="license">{{ __('static.licenses') }}</label>
                        <input type="file" id="license" name="license" accept=".pdf,.jpg,.jpeg,.png" />
                        @error('license')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-row">
                        <label for="birth_date">{{ __('static.birth_date') }}</label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" />
                        @error('birth_date')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="confirm-box">
                        <label class="custom-checkbox">
                            <input type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }} required />
                            <span class="checkmark"></span>
                            {{ __('static.agree_terms') }}
                        </label>
                        @error('terms')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-submit text-center">
                        <button type="submit">{{ __('static.create_account_button') }}</button>
                    </div>
                </form>

                <p class="form-bottom">{{ __('static.have_account') }} <a href="{{ route('login') }}">{{ __('static.login_button') }}</a></p>
            </div>
        </div>
    </section>
</main>
@endsection
