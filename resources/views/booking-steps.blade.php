@extends('layouts.app')

@section('title', __('static.booking_confirmation_title') . ' - Shaheq')

@section('content')
<!-- Desktop Nine Main Area Start -->
<main>
    <section class="desktop-nine-main">
        <div class="container">
            <div class="desktop-nine-wrpper">
                <h2>{{ __('static.booking_confirmation_title') }}</h2>

                
                <form method="POST" action="{{ route('booking.confirmation.submit', $booking->id) }}">
                    @csrf
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <!-- Step 1: Order Details -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne"
                                    aria-expanded="true"
                                    aria-controls="flush-collapseOne"
                                >
                                    <div class="btn-cntn d-flex align-items-center">
                                        <h4>{{ __('static.order_details') }}</h4>
                                        <p>{{ $trip->localized_title }}</p>
                                    </div>
                                    <ul class="btn-price-card d-flex align-items-center">
                                        <li>
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="16"
                                                viewBox="0 0 24 16"
                                                fill="none"
                                            >
                                                <path
                                                    d="M19 16H5C3.67441 15.9984 2.40356 15.4711 1.46622 14.5338C0.528882 13.5964 0.00158786 12.3256 0 11L0 5C0.00158786 3.67441 0.528882 2.40356 1.46622 1.46622C2.40356 0.528882 3.67441 0.00158786 5 0H19C20.3256 0.00158786 21.5964 0.528882 22.5338 1.46622C23.4711 2.40356 23.9984 3.67441 24 5V11C23.9984 12.3256 23.4711 13.5964 22.5338 14.5338C21.5964 15.4711 20.3256 15.9984 19 16ZM5 2C4.20435 2 3.44129 2.31607 2.87868 2.87868C2.31607 3.44129 2 4.20435 2 5V11C2 11.7956 2.31607 12.5587 2.87868 13.1213C3.44129 13.6839 4.20435 14 5 14H19C19.7956 14 20.5587 13.6839 21.1213 13.1213C21.6839 12.5587 22 11.7956 22 11V5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7956 2 19 2H5ZM12 12C11.2089 12 10.4355 11.7654 9.77772 11.3259C9.11992 10.8864 8.60723 10.2616 8.30448 9.53073C8.00173 8.79983 7.92252 7.99556 8.07686 7.21964C8.2312 6.44371 8.61216 5.73098 9.17157 5.17157C9.73098 4.61216 10.4437 4.2312 11.2196 4.07686C11.9956 3.92252 12.7998 4.00173 13.5307 4.30448C14.2616 4.60723 14.8864 5.11992 15.3259 5.77772C15.7654 6.43552 16 7.20887 16 8C16 9.06087 15.5786 10.0783 14.8284 10.8284C14.0783 11.5786 13.0609 12 12 12ZM12 6C11.6044 6 11.2178 6.1173 10.8889 6.33706C10.56 6.55682 10.3036 6.86918 10.1522 7.23463C10.0009 7.60009 9.96126 8.00222 10.0384 8.39018C10.1156 8.77814 10.3061 9.13451 10.5858 9.41421C10.8655 9.69392 11.2219 9.8844 11.6098 9.96157C11.9978 10.0387 12.3999 9.99913 12.7654 9.84776C13.1308 9.69638 13.4432 9.44004 13.6629 9.11114C13.8827 8.78224 14 8.39556 14 8C14 7.46957 13.7893 6.96086 13.4142 6.58579C13.0391 6.21071 12.5304 6 12 6ZM5 4C4.80222 4 4.60888 4.05865 4.44443 4.16853C4.27998 4.27841 4.15181 4.43459 4.07612 4.61732C4.00043 4.80004 3.98063 5.00111 4.01921 5.19509C4.0578 5.38907 4.15304 5.56725 4.29289 5.70711C4.43275 5.84696 4.61093 5.9422 4.80491 5.98079C4.99889 6.01937 5.19996 5.99957 5.38268 5.92388C5.56541 5.84819 5.72159 5.72002 5.83147 5.55557C5.94135 5.39112 6 5.19778 6 5C6 4.73478 5.89464 4.48043 5.70711 4.29289C5.51957 4.10536 5.26522 4 5 4ZM18 5C18 5.19778 18.0586 5.39112 18.1685 5.55557C18.2784 5.72002 18.4346 5.84819 18.6173 5.92388C18.8 5.99957 19.0011 6.01937 19.1951 5.98079C19.3891 5.9422 19.5673 5.84696 19.7071 5.70711C19.847 5.56725 19.9422 5.38907 19.9808 5.19509C20.0194 5.00111 19.9996 4.80004 19.9239 4.61732C19.8482 4.43459 19.72 4.27841 19.5556 4.16853C19.3911 4.05865 19.1978 4 19 4C18.7348 4 18.4804 4.10536 18.2929 4.29289C18.1054 4.48043 18 4.73478 18 5ZM5 10C4.80222 10 4.60888 10.0586 4.44443 10.1685C4.27998 10.2784 4.15181 10.4346 4.07612 10.6173C4.00043 10.8 3.98063 11.0011 4.01921 11.1951C4.0578 11.3891 4.15304 11.5673 4.29289 11.7071C4.43275 11.847 4.61093 11.9422 4.80491 11.9808C4.99889 12.0194 5.19996 11.9996 5.38268 11.9239C5.56541 11.8482 5.72159 11.72 5.83147 11.5556C5.94135 11.3911 6 11.1978 6 11C6 10.7348 5.89464 10.4804 5.70711 10.2929C5.51957 10.1054 5.26522 10 5 10ZM18 11C18 11.1978 18.0586 11.3911 18.1685 11.5556C18.2784 11.72 18.4346 11.8482 18.6173 11.9239C18.8 11.9996 19.0011 12.0194 19.1951 11.9808C19.3891 11.9422 19.5673 11.847 19.7071 11.7071C19.847 11.5673 19.9422 11.3891 19.9808 11.1951C20.0194 11.0011 19.9996 10.8 19.9239 10.6173C19.8482 10.4346 19.72 10.2784 19.5556 10.1685C19.3911 10.0586 19.1978 10 19 10C18.7348 10 18.4804 10.1054 18.2929 10.2929C18.1054 10.4804 18 10.7348 18 11Z"
                                                    fill="#F5A359"
                                                />
                                            </svg>
                                        </li>
                                        <li>{{ number_format(isset($trip) ? $trip->price : 300, 0) }}</li>
                                        <li>
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="10"
                                                height="12"
                                                viewBox="0 0 10 12"
                                                fill="none"
                                            >
                                                <g clip-path="url(#clip0_7898_406)">
                                                    <path
                                                        d="M6.2236 10.2452C6.04515 10.6346 5.92719 11.0572 5.882 11.5004L9.65831 10.7103C9.83676 10.321 9.95463 9.89827 9.99991 9.45508L6.2236 10.2452Z"
                                                        fill="#3B6A7F"
                                                    />
                                                    <path
                                                        d="M9.65828 8.34295C9.83673 7.9536 9.95469 7.5309 9.99988 7.08771L7.05825 7.70346V6.51975L9.65819 5.97597C9.83664 5.58662 9.9546 5.16392 9.99979 4.72073L7.05816 5.33596V1.07898C6.60742 1.32807 6.20711 1.65963 5.88171 2.05073V5.58216L4.70525 5.82827V0.5C4.25451 0.748999 3.8542 1.08065 3.5288 1.47174V6.07429L0.896474 6.62482C0.718027 7.01416 0.599981 7.43687 0.554702 7.88006L3.5288 7.258V8.74866L0.341472 9.41529C0.163025 9.80464 0.045068 10.2273 -0.00012207 10.6705L3.33612 9.97274C3.6077 9.91714 3.84113 9.75911 3.99289 9.54163L4.60473 8.64886V8.64868C4.66825 8.55631 4.70525 8.44495 4.70525 8.325V7.01189L5.88171 6.76578V9.13319L9.65819 8.34277L9.65828 8.34295Z"
                                                        fill="#3B6A7F"
                                                    />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_7898_406">
                                                        <rect
                                                            width="10"
                                                            height="11"
                                                            fill="white"
                                                            transform="translate(0 0.5)"
                                                        />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </li>
                                    </ul>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>{{ __('static.name') }}</label>
                                                <p class="form-control-plaintext">{{ $booking->user->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>{{ __('static.email') }}</label>
                                                <p class="form-control-plaintext">{{ $booking->user->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>{{ __('static.phone') }}</label>
                                                <p class="form-control-plaintext">{{ $booking->phone_number ?? $booking->user->phone_number }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>{{ __('static.notes') }}</label>
                                                <p class="form-control-plaintext">{{ $booking->notes ?? __('static.no_notes') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Payment -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo"
                                    aria-expanded="false"
                                    aria-controls="flush-collapseTwo"
                                >
                                    <div class="btn-cntn">
                                        <h4>{{ __('static.payment') }}</h4>
                                    </div>
                                </button>
                            </h2>
                            <div
                                id="flush-collapseTwo"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample"
                            >
                                <div class="accordion-body">
                                    <div class="form-group mb-3">
                                        <label>{{ __('static.payment_method') }}</label>
                                        <div id="payment-options" class="payment-options">
                                            <!-- Method Row -->
                                            <div class="option-row">
                                                <!-- Visa Method -->
                                                <div class="single-payout-method">
                                                    <div class="radio-row">
                                                        <input
                                                            type="radio"
                                                            id="payment_method_visa"
                                                            name="payment_method"
                                                            value="visa"
                                                            {{ old('payment_method') == 'visa' ? 'checked' : '' }}
                                                            required
                                                        />
                                                        <label for="payment_method_visa" class="radio-label">
                                                            <span class="radio-custom" aria-hidden="true"></span>
                                                            <img src="{{ asset('images/payout-method-2.png ') }}" alt="Visa" />
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- Mada Method -->
                                                <div class="single-payout-method">
                                                    <div class="radio-row">
                                                        <input
                                                            type="radio"
                                                            id="payment_method_mada"
                                                            name="payment_method"
                                                            value="mada"
                                                            {{ old('payment_method') == 'mada' ? 'checked' : '' }}
                                                        />
                                                        <label for="payment_method_mada" class="radio-label">
                                                            <span class="radio-custom" aria-hidden="true"></span>
                                                            <img src="{{ asset('images/payout-option-one.png') }}" alt="Mada" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Method Row -->
                                            <div class="option-row">
                                                <!-- PayPal Method -->
                                                <div class="single-payout-method">
                                                    <div class="radio-row">
                                                        <input
                                                            type="radio"
                                                            id="payment_method_paypal"
                                                            name="payment_method"
                                                            value="paypal"
                                                            {{ old('payment_method') == 'paypal' ? 'checked' : '' }}
                                                        />
                                                        <label for="payment_method_paypal" class="radio-label">
                                                            <span class="radio-custom" aria-hidden="true"></span>
                                                            <img  src="{{ asset('images/payout-option-4.png') }}" alt="PayPal" />
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- Apple Pay Method -->
                                                <div class="single-payout-method">
                                                    <div class="radio-row">
                                                        <input
                                                            type="radio"
                                                            id="payment_method_apple_pay"
                                                            name="payment_method"
                                                            value="apple_pay"
                                                            {{ old('payment_method') == 'apple_pay' ? 'checked' : '' }}
                                                        />
                                                        <label for="payment_method_apple_pay" class="radio-label">
                                                            <span class="radio-custom" aria-hidden="true"></span>
                                                            <img class="d-none d-md-block" src="{{ asset('images/payout-option-3.png') }}" alt="Apple Pay" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Method Row -->
                                            <div class="option-row">
                                                <!-- Tabby Method -->
                                                <div class="single-payout-method">
                                                    <div class="radio-row">
                                                        <input
                                                            type="radio"
                                                            id="payment_method_tabby"
                                                            name="payment_method"
                                                            value="tabby"
                                                            {{ old('payment_method') == 'tabby' ? 'checked' : '' }}
                                                        />
                                                        <label for="payment_method_tabby" class="radio-label">
                                                            <span class="radio-custom" aria-hidden="true"></span>
                                                            <img src="{{ asset('images/payout-option-6.png') }}" alt="Tabby" />
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- Tamara Method -->
                                                <div class="single-payout-method">
                                                    <div class="radio-row">
                                                        <input
                                                            type="radio"
                                                            id="payment_method_tamara"
                                                            name="payment_method"
                                                            value="tamara"
                                                            {{ old('payment_method') == 'tamara' ? 'checked' : '' }}
                                                        />
                                                        <label for="payment_method_tamara" class="radio-label">
                                                            <span class="radio-custom" aria-hidden="true"></span>
                                                            <img src="{{ asset('images/payout-option-5.png') }}" alt="Tamara" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Method Row -->
                                            <div class="option-row">
                                                <!-- Bank Transfer Method -->
                                                <div class="single-payout-method">
                                                    <div class="radio-row">
                                                        <input
                                                            type="radio"
                                                            id="payment_method_bank_transfer"
                                                            name="payment_method"
                                                            value="bank_transfer"
                                                            {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}
                                                        />
                                                        <label for="payment_method_bank_transfer" class="radio-label">
                                                            <span class="radio-custom" aria-hidden="true"></span>
                                                            <img src="{{ asset('images/payout-option-7.png') }}" alt="Bank Transfer" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('payment_method')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="booking-confirm-wrpper">
                        <button type="submit">{{ __('static.confirm_order') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<!-- Desktop Nine Main Area End -->
@endsection

@section('scripts')
<script>
    // Update summary when participants count changes
    document.getElementById('participants_count').addEventListener('change', function() {
        const participantsCount = parseInt(this.value) || 1;
        const tripPrice = {{ isset($trip) ? $trip->price : 300 }};
        const totalAmount = participantsCount * tripPrice;
        
        document.getElementById('summary-participants').textContent = participantsCount;
        document.getElementById('summary-total').textContent = totalAmount.toLocaleString() + ' ريال';
    });
</script>
@endsection
