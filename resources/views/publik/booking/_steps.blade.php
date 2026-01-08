<div class="d-flex flex-wrap align-items-center mb-4 small" style="gap:10px;">
    <span class="fw-semibold text-primary">Product List</span>
    <span>→</span>
    <span class="fw-semibold text-primary">Product Detail</span>
    <span>→</span>
    {{-- <span class="fw-semibold text-primary">Shopping Cart</span>
    <span>→</span> --}}
    <span class="fw-semibold text-primary">Booking Detail</span>
    <span>→</span>
    <span class="text-muted">Payment</span>
    <span>→</span>
    <span class="text-muted">Finish</span>
</div>


{{-- <div class="booking-steps">
    @php
        $steps = [
            'Product List',
            'Product Detail',
            'Shopping Cart',
            'Booking Detail',
            'Payment',
            'Finish'
        ];
    @endphp

    @foreach ($steps as $i => $label)
        <div class="step-item {{ $i < $currentStep ? 'done' : '' }}">
            <span class="step-badge">{{ $i + 1 }}</span>
            {{ $label }}
        </div>
    @endforeach
</div> --}}
