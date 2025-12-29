@extends('layouts.app')

@section('title', 'فريق المرشدين - Shaheq')

@section('content')

<!-- Desktop Four Hero Area Start -->
<section class="desktop-four-hero-area">
    <div class="container">
        <div class="desktop-four-hero-wrpper">
            <h3>
                {{ __('static.guides_subtitle_1') }}
            </h3>
            <h3>
                {{ __('static.guides_subtitle_2') }}
            </h3>
        </div>
    </div>
    <img src="images/desktop-4-hero-after.png" alt="" />
</section>
<!-- Desktop Four Hero Area End -->

<!-- Meet Our Heroes Start -->
<section class="meet-our-heroes-area">
    <div class="container">
        <div class="meet-our-heroes-wrpper">
            <h2>{{ __('static.meet_our_heroes') }}</h2>
            <div class="row">
                @forelse($guides as $guide)
                <!-- Single Hero Card -->
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="single-hero-card">
                        <div class="hero-image">
                            <img
                                src="images/single-hero-image.png"
                                alt="{{ $guide->localized_name }}"
                            />
                        </div>
                        <div class="hero-desc">
                            <h4>{{ $guide->localized_name }}</h4>
                            <p>
                                {{ $guide->localized_bio }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <p>{{ __('static.no_guides_available') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
<!-- Meet Our Heroes End -->

<!-- Why Choose Us Start -->
<section class="why-choose-us-area">
    <div class="container">
        <div class="why-choose-us-wrpper">
            <h2>{{ __('static.why_choose_us') }}</h2>
            <ul class="choose-us-list">
                <li>
                    <div class="choose-icon">
                        <img src="images/choose-us-icon-1.png" alt="" />
                    </div>
                    <span>{{ __('static.certified') }}</span>
                </li>
                <li>
                    <div class="choose-icon">
                        <img src="images/choose-us-icon-2.png" alt="" />
                    </div>
                    <span>{{ __('static.experience') }}</span>
                </li>
                <li>
                    <div class="choose-icon">
                        <img src="images/choose-us-icon-3.png" alt="" />
                    </div>
                    <span>{{ __('static.enthusiasm') }}</span>
                </li>
                <li>
                    <div class="choose-icon">
                        <img src="images/choose-us-icon-4.png" alt="" />
                    </div>
                    <span>{{ __('static.safety_first') }}</span>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- Why Choose Us End -->
@endsection
