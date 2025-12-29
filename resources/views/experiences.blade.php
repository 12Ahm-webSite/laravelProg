@extends('layouts.app')

@section('title', 'أنواع التجارب - Shaheq')

@section('content')

<!-- Desktop Three Main Area Start -->
<main>
    <!-- Hero Area Start -->
    <section class="desktop-three-hero">
        <div class="container">
            <div class="desktop-three-hero-wrpper">
                <div class="desktop-three-hero-cntn">
                    <h2>{{ __('static.experiences_title') }}</h2>
                    <h3>{{ __('static.experiences_subtitle') }}</h3>
                    <h4>{{ __('static.experience_categories') }}</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Area End -->

    <!-- Experiment Categories Start -->
    <section class="experiment-categories-area">
        <div class="container">
            <div class="desktop-three-hero-cntn">
                <h4>{{ __('static.experience_categories') }}</h4>
            </div>
            <div class="experiment-categories-wrpper">
                <div class="row align-items-center">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="categories">
                            <!-- Single Category -->
                            <div class="single-category">
                                <img
                                    src="images/category-icon-1.png"
                                    alt=""
                                />
                                <h3>{{ __('static.mountain_adventures') }}</h3>
                                <p>{{ __('static.mountain_adventures_description') }}</p>
                            </div>
                            <!-- Single Category -->
                            <div class="single-category">
                                <img
                                    src="images/category-icon-2.png"
                                    alt=""
                                />
                                <h3>{{ __('static.desert_trips') }}</h3>
                                <p>{{ __('static.desert_trips_description') }}</p>
                            </div>
                            <!-- Single Category -->
                            <div class="single-category">
                                <img
                                    src="images/category-icon-3.png"
                                    alt=""
                                />
                                <h3>{{ __('static.cultural_experiences') }}</h3>
                                <p>{{ __('static.cultural_experiences_description') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="experiment-categories-img">
                            <img src="images/about-img-3.png" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-3 order-3">
                        <div class="categories">
                            <!-- Single Category -->
                            <div class="single-category">
                                <img
                                    src="images/category-icon-4.png"
                                    alt=""
                                />
                                <h3>{{ __('static.sea_trips') }}</h3>
                                <p>{{ __('static.sea_trips_description') }}</p>
                            </div>
                            <!-- Single Category -->
                            <div class="single-category">
                                <img
                                    src="images/category-icon-5.png"
                                    alt=""
                                />
                                <h3>{{ __('static.photography_trips') }}</h3>
                                <p>{{ __('static.photography_trips_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Experiment Categories End -->

    <!-- Ready to live Start -->
    <section class="ready-to-live">
        <div class="container">
            <div class="ready-to-live-wrpper">
                <h3>{{ __('static.ready_live_adventure') }}<br />{{ __('static.register_shaheq') }}</h3>
                <a href="#">{{ __('static.explore_now') }}</a>
            </div>
        </div>
    </section>
    <!-- Ready to live End -->
</main>
<!-- Desktop Three Main Area End -->
@endsection
