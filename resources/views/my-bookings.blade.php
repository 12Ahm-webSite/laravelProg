@extends('layouts.app')

@section('title', 'حجوزاتي')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">حجوزاتي</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($bookings->count() > 0)
                <div class="row">
                    @foreach($bookings as $booking)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                @if($booking->trip->main_image)
                                    <img src="{{ asset('images/' . $booking->trip->main_image) }}" class="card-img-top" alt="{{ $booking->trip->localized_title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/slider-item-1.png') }}" class="card-img-top" alt="{{ $booking->trip->localized_title }}" style="height: 200px; object-fit: cover;">
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $booking->trip->localized_title }}</h5>
                                    <p class="card-text text-muted">{{ $booking->trip->category->name ?? 'غير محدد' }}</p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i> {{ $booking->trip->start_date->format('Y-m-d') }}<br>
                                            <i class="fas fa-users"></i> {{ $booking->participants_count }} مشارك<br>
                                            <i class="fas fa-money-bill"></i> {{ number_format($booking->total_amount, 0) }} ريال
                                        </small>
                                    </p>
                                    
                                    <div class="mt-auto">
                                        <span class="badge 
                                            @if($booking->status == 'confirmed') bg-success
                                            @elseif($booking->status == 'pending') bg-warning
                                            @elseif($booking->status == 'cancelled') bg-danger
                                            @else bg-secondary
                                            @endif">
                                            @if($booking->status == 'confirmed') مؤكد
                                            @elseif($booking->status == 'pending') في الانتظار
                                            @elseif($booking->status == 'cancelled') ملغي
                                            @else {{ $booking->status }}
                                            @endif
                                        </span>
                                        
                                        @if($booking->status == 'pending')
                                            <form method="POST" action="{{ route('booking.cancel', $booking->id) }}" class="d-inline mt-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('هل أنت متأكد من إلغاء الحجز؟')">
                                                    إلغاء الحجز
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="text-center">
                    <div class="alert alert-info">
                        <h4>لا توجد حجوزات</h4>
                        <p>لم تقم بأي حجوزات بعد. ابدأ بالاستكشاف واختر رحلتك المفضلة!</p>
                        <a href="{{ route('destinations') }}" class="btn btn-primary">استكشف الرحلات</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
