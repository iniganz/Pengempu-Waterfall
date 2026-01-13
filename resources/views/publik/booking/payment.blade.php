@extends('publik.layout.index')

@section('content')
    <div class="container my-5">
        @include('publik.booking._steps')

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Payment</h5>
                        <p class="text-muted small mb-3">Order ID: {{ $orderId }}</p>
                        <div id="snap-container"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Booking Summary</h6>
                        <table class="table-sm mb-0 table">
                            <tr>
                                <th class="small">Nama</th>
                                <td class="small">{{ $booking['name'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="small">Email</th>
                                <td class="small">{{ $booking['email'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="small">No HP</th>
                                <td class="small">{{ $booking['phone'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="small">Tanggal</th>
                                <td class="small">{{ $booking['reserve_date'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="small">Qty</th>
                                <td class="small">{{ $booking['qty'] ?? 1 }} Ticket</td>
                            </tr>
                            <tr>
                                <th class="small">Total</th>
                                <td class="small fw-bold text-success">IDR
                                    {{ number_format($booking['total'] ?? ($price ?? 0), 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- Snap JS only here on payment page --}}
    <script src="{{ $midSnapUrl }}" data-client-key="{{ $midClientKey }}"></script>
    {{-- <script src="{{ $midSnapUrl }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            snap.embed(@json($snapToken), {
                embedId: 'snap-container'
            });
        });
    </script>

    {{-- Embed token --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (typeof window.snap === 'undefined') {
                console.error('Midtrans Snap belum ter-load');
                return;
            }

            const snapToken = @json($snapToken);

            if (!snapToken) {
                console.error('Snap token kosong');
                return;
            }

            window.snap.embed(snapToken, {
                embedId: 'snap-container',

                onSuccess: function(result) {
                    window.location.href = "{{ route('booking.finish', $product) }}";
                },

                onPending: function(result) {
                    console.log('Payment pending:', result);
                },

                onError: function(result) {
                    console.error('Payment error:', result);
                },

                onClose: function() {
                    console.log('Payment popup closed');
                }
            });
        });


        // document.addEventListener('DOMContentLoaded', function() {
        //     // ensure snap lib loaded
        //     if (typeof window.snap === 'undefined') {
        //         console.error(
        //         'Midtrans Snap library belum ter-load. Pastikan script src ada dan client-key benar.');
        //         return;
        //     }

        //     const snapToken = @json($snapToken); // string

        //     if (!snapToken) {
        //         console.error('Snap token kosong dari server');
        //         return;
        //     }

        //     try {
        //         window.snap.embed(snapToken, {
        //             embedId: 'snap-container',
        //             onSuccess(result) {
        //                 console.log('success', result); /* redirect or save */
        //             },
        //             onPending(result) {
        //                 console.log('pending', result);
        //             },
        //             onError(result) {
        //                 console.error('midtrans error', result);
        //             },
        //             onClose() {
        //                 console.log('closed');
        //             }
        //         });
        //     } catch (err) {
        //         console.error('snap.embed exception', err);
        //     }
        // });
    </script>
@endpush
