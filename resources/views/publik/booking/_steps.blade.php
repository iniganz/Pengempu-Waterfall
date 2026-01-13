@php
    // Define all steps in order
    $allSteps = [
        'product' => ['label' => 'Product List', 'order' => 1],
        'product-detail' => ['label' => 'Product Detail', 'order' => 2],
        'booking' => ['label' => 'Booking Detail', 'order' => 3],
        'payment' => ['label' => 'Payment', 'order' => 4],
        'finish' => ['label' => 'Finish', 'order' => 5],
    ];

    // Determine current step based on route
    $currentRoute = request()->route()->getName();
    $currentStep = null;
    $currentOrder = 0;

    if (str_contains($currentRoute, 'product') && !str_contains($currentRoute, 'booking')) {
        $currentStep = 'product-detail';
        $currentOrder = 2;
    } elseif (str_contains($currentRoute, 'booking.show')) {
        $currentStep = 'booking';
        $currentOrder = 3;
    } elseif (str_contains($currentRoute, 'booking.payment')) {
        $currentStep = 'payment';
        $currentOrder = 4;
    } elseif (str_contains($currentRoute, 'booking.finish')) {
        $currentStep = 'finish';
        $currentOrder = 5;
    }
@endphp

<div class="d-flex flex-wrap align-items-center mb-4 small" style="gap:10px;">
    @foreach ($allSteps as $stepKey => $step)
        @php
            // Step sebelum current step = completed (✓)
            $isCompleted = $step['order'] < $currentOrder;

            // Step saat ini = active (biru)
            $isActive = $currentStep === $stepKey;

            // Step sesudah current step = disabled (abu-abu)
            $isDisabled = $step['order'] > $currentOrder;
        @endphp

        <span class="fw-semibold {{ $isActive ? 'text-primary' : ($isCompleted ? 'text-success' : 'text-muted') }}">
            @if($isCompleted)
                ✓ {{ $step['label'] }}
            @else
                {{ $step['label'] }}
            @endif
        </span>

        @if (!$loop->last)
            <span class="text-muted">→</span>
        @endif
    @endforeach
</div>
