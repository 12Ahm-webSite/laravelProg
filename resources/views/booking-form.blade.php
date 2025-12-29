@extends('layouts.app')

@section('title', __('static.booking_title') . ' - Shaheq')

@section('content')
<!-- Booking Confirmation Form -->
<section class="booking-confirmation-area">
    <div class="container">
        <div class="booking-confirmation-wrpper">
            <h3>{{ __('static.confirm_booking') }}</h3>

            
            <form method="POST" action="{{ route('trip.book.submit', isset($trip) ? $trip->id : 1) }}">
                @csrf
                <div class="input-row">
                    <label for="participant_name">{{ __('static.full_name') }}</label>
                    <input
                        type="text"
                        id="participant_name"
                        name="participant_name"
                        placeholder="{{ __('static.full_name_placeholder') }}"
                        value="{{ old('participant_name') }}"
                        required
                    />
                    @error('participant_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="input-row">
                    <label for="participant_email">{{ __('static.email') }}</label>
                    <input
                        type="email"
                        id="participant_email"
                        name="participant_email"
                        placeholder="{{ __('static.email') }}"
                        value="{{ old('participant_email') }}"
                        required
                    />
                    @error('participant_email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="input-row">
                    <label for="participant_phone">{{ __('static.phone_number') }}</label>
                    <div class="form-group">
                        <input
                            type="text"
                            id="participant_phone"
                            name="participant_phone"
                            placeholder="{{ __('static.phone_placeholder') }}"
                            value="{{ old('participant_phone') }}"
                            required
                        />
                    </div>
                    @error('participant_phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                

                
                <div class="input-row">
                    <label for="notes">{{ __('static.notes') }}</label>
                    <textarea 
                        name="notes" 
                        id="notes" 
                        placeholder="{{ __('static.notes_placeholder') }}"
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="form-submit text-center">
                    <button type="submit">{{ __('static.confirm_data') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Calculate total amount when participants count changes
    document.getElementById('participants_count').addEventListener('change', function() {
        const participantsCount = this.value;
        const tripPrice = {{ isset($trip) ? $trip->price : 0 }};
        const totalAmount = participantsCount * tripPrice;
        
        // You can display the total amount somewhere on the page
        console.log('Total amount:', totalAmount);
    });
</script>
@endsection
