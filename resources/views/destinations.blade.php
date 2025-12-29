@extends('layouts.app')

@section('title', 'الوجهات - Shaheq')

@section('content')


<!-- Desktop Two Banner Area Start -->
<section class="desktop-one-banner-area">
    <div class="container">
        <div class="desktop-one-banner-cntn desktop-two-banner-cntn">
            <h3>{{ __('static.destinations') }}</h3>
            <p>{{ __('static.destinations_description') }}</p>
        </div>
    </div>
</section>
<!-- Desktop Two Banner Area End -->

<!-- Main Area Start -->
<main class="desktop-2-main">
    <!-- Single Post Row -->
    <section class="">
        <div
            class="row g-0 align-items-center post-row-tow desktop-tow-post-row"
        >
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="post-cntn">
                    <h3>{{ __('static.northern_region') }}</h3>
                    <p>{{ __('static.northern_region_description') }}</p>
                    <p>{{ __('static.distinctive_experiences') }}:</p>
                    <ul>
                        <li>{{ __('static.mountain_climbing') }}</li>
                        <li>{{ __('static.desert_safari') }}</li>
                        <li>{{ __('static.stargazing') }}</li>
                        <li>{{ __('static.photography_trips') }}</li>
                        <li>{{ __('static.camping') }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="post-thumnail desktop-two">
                    <img
                        src="images/desktop-two-post-thum.png"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </section>
    <!-- Single Post Row -->
    <section class="">
        <div
            class="row g-0 align-items-center desktop-tow-post-row-two"
        >
            <div class="col-lg-6">
                <div class="post-thumnail desktop-two">
                    <img
                        src="images/desktop-two-post-thum.png"
                        alt=""
                    />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="post-cntn">
                    <h3>{{ __('static.southern_region') }}</h3>
                    <p>{{ __('static.southern_region_description') }}</p>
                    <p>{{ __('static.distinctive_experiences') }}:</p>
                    <ul>
                        <li>{{ __('static.forest_trips') }}</li>
                        <li>{{ __('static.historical_sites') }}</li>
                        <li>{{ __('static.diving_relaxation') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Single Post Row -->
    <section class="">
        <div
            class="row g-0 align-items-center post-row-tow desktop-tow-post-row"
        >
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="post-cntn">
                    <h3>{{ __('static.eastern_region') }}</h3>
                    <p>{{ __('static.eastern_region_description') }}</p>
                    <p>{{ __('static.distinctive_experiences') }}:</p>
                    <ul>
                        <li>{{ __('static.diving_water_sports') }}</li>
                        <li>{{ __('static.beach_camping') }}</li>
                        <li>{{ __('static.sand_dune_safari') }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="post-thumnail desktop-two">
                    <img
                        src="images/desktop-two-post-thum.png"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </section>
    <!-- Single Post Row -->
    <section class="">
        <div
            class="row g-0 align-items-center desktop-tow-post-row-two"
        >
            <div class="col-lg-6">
                <div class="post-thumnail desktop-two">
                    <img
                        src="images/desktop-two-post-thum.png"
                        alt=""
                    />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="post-cntn">
                    <h3>{{ __('static.western_region') }}</h3>
                    <p>{{ __('static.western_region_description') }}</p>
                    <p>{{ __('static.distinctive_experiences') }}:</p>
                    <ul>
                        <li>{{ __('static.heritage_exploration') }}</li>
                        <li>{{ __('static.marine_tours') }}</li>
                        <li>{{ __('static.unforgettable_sunset') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Single Post Row -->
    <section class="">
        <div
            class="row g-0 align-items-center post-row-tow desktop-tow-post-row"
        >
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="post-cntn">
                    <h3>{{ __('static.central_region') }}</h3>
                    <p>{{ __('static.central_region_description') }}</p>
                    <p>{{ __('static.distinctive_experiences') }}:</p>
                    <ul>
                        <li>{{ __('static.horse_camel_riding') }}</li>
                        <li>{{ __('static.sand_dune_safari') }}</li>
                        <li>{{ __('static.heritage_cultural_events') }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="post-thumnail desktop-two">
                    <img
                        src="images/desktop-two-post-thum.png"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </section>
</main>
<!-- Main Area End -->

<!-- Desktop Two One Line Text -->
<section class="desktop-tow-one-line-text">
    <div class="container">
        <div class="desktop-two-one-line-text-card">
            <p>{{ __('static.wherever_destination') }}</p>
            <p>{{ __('static.experience_to_live') }}</p>
        </div>
    </div>
</section>
<!-- Desktop Two One Line Text -->
@endsection

@push('scripts')
<!-- Scroll-Top button -->
<a href="#" class="scrolltotop" style="display: none">
    <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
    <span class="pluse"></span>
    <span class="pluse2"></span>
</a>
@endpush
