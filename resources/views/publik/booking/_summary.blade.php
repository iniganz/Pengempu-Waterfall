<div class="card shadow-sm">
    <div class="card-body">

        <div class="row align-items-center mb-3">
            <div class="col-4 fw-semibold">Person</div>
            <div class="col-4">IDR 30.000 / Ticket</div>
            <div class="col-4 d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-outline-secondary">−</button>
                <span>2</span>
                <button class="btn btn-sm btn-outline-secondary">+</button>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <label class="form-label small">Reserve Date</label>
                <input type="date" class="form-control" value="2025-11-28">
            </div>
            <div class="col-6 text-end">
                <label class="form-label small d-block">Total</label>
                <div class="fw-bold fs-4 text-success">IDR 30.000</div>
            </div>
        </div>

        <button class="btn btn-success w-100 fw-semibold">
            Book Now
        </button>

    </div>
</div>


{{--
<div class="booking-card" data-price="{{ $price }}">
    <div class="booking-row">

        <div class="box">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <div class="fw-bold">Person</div>
                    <small class="text-muted">IDR {{ number_format($price, 0, ',', '.') }} / Ticket</small>
                </div>

                <div class="qty-control">
                    <button type="button" class="qty-btn" id="qty-dec">-</button>
                    <input id="qty-input" type="number" min="1" value="1">
                    <button type="button" class="qty-btn" id="qty-inc">+</button>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3 flex-wrap gap-3">
                <div>
                    <div class="fw-bold">Reserve Date</div>
                    <input type="date" id="reserve-date" class="form-control" value="{{ now()->toDateString() }}">
                </div>

                <div>
                    <div class="fw-bold">Our Location</div>
                    <small>{{ $location }}</small>
                </div>
            </div>
        </div>

        <div class="total-card">
            <div class="text-muted fw-semibold">Total</div>
            <div class="price" id="total-price"></div>
            <button class="btn btn-success w-100 mt-2">
                Book Now
            </button>
        </div>

    </div>
</div> --}}
