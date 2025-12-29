@extends('layouts.app')

@section('title', 'قصص السفر - Shaheq')

@section('content')


<!-- Desktop Five Hero Area Start -->
<section class="desktop-five-hero">
    <div class="container">
        <div class="desktop-five-hero-wrpper">
            <h2>{{ __('static.stories_title') }}</h2>
            <h3>
                {{ __('static.stories_subtitle') }}
            </h3>
        </div>
    </div>
</section>
<!-- Desktop Five Hero Area End -->

<!-- Banner Area Start -->
<section class="desktop-five-banner">
    <div class="container">
        <div class="desktop-five-banner-wrpper">
            <img src="images/desktop-five-banner.png" alt="" />
            <div class="desktop-five-banner-cntn">
                <h3>{{ __('static.red_sea_diving') }}</h3>
                <h2>{{ __('static.stories_banner_description') }}</h2>
                <a href="#">{{ __('static.watch_video') }}</a>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<section class="divider">
    <img
        class="d-none d-md-block"
        src="images/desktop-five-divider.png"
        alt=""
    />
    <img class="d-md-none" src="images/divider-mobile.png" alt="" />
</section>

<!-- Explore Now Area Start -->
<section class="explore-now-area">
    <div class="container">
        <div class="desktop-five-banner-cntn">
            <h2>
                {{ __('static.ready_for_your_story') }}
            </h2>
            <a href="{{ route('booking') }}">{{ __('static.explore_now') }}</a>
        </div>
    </div>
</section>
<!-- Explore Now Area End -->
@endsection
