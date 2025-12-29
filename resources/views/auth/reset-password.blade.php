@extends('layouts.app')

@section('title', __('static.reset_password_title'))

@section('content')
<main>
    <!-- Booking Confirmation Form -->
    <section id="desktop-seventen" class="booking-confirmation-area">
        <div class="container">
            <div class="booking-confirmation-wrpper">
                <h3>{{ __('static.reset_password_heading') }}</h3>
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Address -->
                    <div class="input-row">
                        <label for="email">{{ __('static.email') }}</label>
                        <div class="form-group">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $email) }}"
                                required
                                autofocus
                                placeholder="example@email.com"
                            />
                            @error('email')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-row mt-4">
                        <label for="password">{{ __('static.password') }}</label>
                        <div class="form-group">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                placeholder="********"
                            />
                            @error('password')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-row mt-4">
                        <label for="password_confirmation">{{ __('static.confirm_password') }}</label>
                        <div class="form-group">
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                placeholder="********"
                            />
                            @error('password_confirmation')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-submit text-center mt-4">
                        <button type="submit">{{ __('static.reset_password_button') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/scripts.js') }}"></script>
@endsection
