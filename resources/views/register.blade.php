@extends('layouts.app')

@section('title', 'Welcome To Shaheq - ' . __('static.register_title'))

@section('content')
    <!-- Mobile Menu Area Start -->
    <aside
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel"
    >
        <div class="offcanvas-header">
            <a href="{{ url('/') }}" id="offcanvasRightLabel">
                <img src="{{ asset('images/shaheq-main-logo.png') }}" alt="shaheq main logo" />
            </a>
            <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            ></button>
        </div>
        <div class="offcanvas-body">
            <nav class="mobile-navbar">
                <ul>
                    <li id="menu-active"><a href="{{ url('/') }}">{{ __('static.home') }}</a></li>
                    <li><a href="#">{{ __('static.about') }}</a></li>
                    <li><a href="#">{{ __('static.destinations') }}</a></li>
                    <li><a href="#">{{ __('static.experiences') }}</a></li>
                    <li><a href="#">{{ __('static.booking') }}</a></li>
                    <li><a href="#">{{ __('static.stories') }}</a></li>
                    <li><a href="#">{{ __('static.guides') }}</a></li>
                    <li><a href="{{ route('login') }}">{{ __('static.login') }}</a></li>
                    <li>
                        @if(app()->getLocale() == 'ar')
                            <a href="{{ route('lang.switch', 'en') }}">EN</a>
                        @else
                            <a href="{{ route('lang.switch', 'ar') }}">AR</a>
                        @endif
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- Mobile Menu Area End -->

    <!-- Desktop Seven Main Area -->
    <main>
        <section id="desktop-seventen" class="booking-confirmation-area">
            <div class="container">
                <div class="booking-confirmation-wrpper">
                    <h3>{{ __('static.register_title') }}</h3>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-row">
                            <label for="name">{{ __('static.full_name') }}</label>
                            <input type="text" id="name" name="name" placeholder="{{ __('static.full_name_placeholder') }}" required />
                        </div>

                        <div class="input-row">
                            <label for="email">{{ __('static.email') }}</label>
                            <input type="email" id="email" name="email" placeholder="{{ __('static.email_placeholder') }}" required />
                        </div>

                        <div class="input-row">
                            <label for="mobile_code">{{ __('static.phone_number') }}</label>
                            <div class="form-group">
                                <input type="text" id="mobile_code" name="phone" placeholder="{{ __('static.phone_placeholder') }}" />
                            </div>
                        </div>

                        <div class="input-row">
                            <label for="password">{{ __('static.password') }}</label>
                            <div class="form-group">
                                <div class="upload-img-icon password">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <input type="password" id="password" name="password" placeholder="********" required />
                            </div>
                        </div>

                        <div class="input-row">
                            <label for="password_confirmation">{{ __('static.confirm_password') }}</label>
                            <div class="form-group">
                                <div class="upload-img-icon re_password">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="********" required />
                            </div>
                        </div>

                        <div class="input-row">
                            <label for="license">{{ __('static.licenses') }}</label>
                            <div class="form-group">
                                <div class="upload-img-icon">
                                    <img src="{{ asset('images/fi-rr-camera.png') }}" alt="" />
                                </div>
                                <input type="file" id="license" name="license" accept=".pdf,.jpg,.jpeg,.png" />
                            </div>
                        </div>

                        <div class="input-row">
                            <label for="birth_date">{{ __('static.birth_date') }}</label>
                            <div class="form-group">
                                <input type="date" id="birth_date" name="birth_date" />
                            </div>
                        </div>

                        <div class="confirm-box">
                            <label class="custom-checkbox">
                                <input type="checkbox" name="terms" required />
                                <span class="checkmark"></span>
                                {{ __('static.agree_terms') }}
                            </label>
                        </div>

                        <div id="desktop-eighten-submit" class="form-submit text-center">
                            <button type="submit">{{ __('static.create_account_button') }}</button>
                        </div>
                    </form>
                    <p class="form-bottom">{{ __('static.have_account') }} <a href="{{ route('login') }}">{{ __('static.login_button') }}</a></p>
                </div>
            </div>
        </section>
    </main>
    <!-- Desktop Seven Main Area -->
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#mobile_code").intlTelInput({
                initialCountry: "SA",
                separateDialCode: true,
            });
        });
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
@endpush