@extends('layouts.app')

@section('title', __('static.booking_confirmation_title') . ' - Shaheq')

@section('content')
<main>
    <section>
        <div class="container">
            <div class="booking-confirm-wrpper">
                <h3>{{ __('static.booking_confirmed_successfully') }}</h3>
                @if(isset($booking))
                    <h4>{{ $booking->id }}</h4>
                @else
                    <h4>147896522</h4>
                @endif
                
                <img src="{{ asset('images/booking-confirm.png') }}" alt="Booking Confirmation" />

                <form action="{{ route('home') }}" method="GET">
                    <button type="submit">{{ __('static.return_to_home') }}</button>
                </form>

                
                <div class="mt-4">
                    <div class="alert alert-info">
                        <h6>{{ __('static.important_information') }}</h6>
                        <ul>
                            <li>{{ __('static.contact_within_24_hours') }}</li>
                            <li>{{ __('static.keep_booking_number') }}</li>
                            <li>{{ __('static.emergency_contact') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
