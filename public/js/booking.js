(function () {
        const box = document.getElementById('distance-box');
        if (!box) return;

        const targetLat = parseFloat(box.dataset.lat);
        const targetLng = parseFloat(box.dataset.lng);
        const valueEl = document.getElementById('distance-value');

        function haversine(lat1, lon1, lat2, lon2) {
            const R = 6371; // km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) ** 2;
            return (R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))).toFixed(2);
        }

        function setText(text) {
            if (valueEl) valueEl.textContent = text;
        }

        if (!navigator.geolocation) {
            setText('Geolocation tidak didukung browser Anda.');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const d = haversine(pos.coords.latitude, pos.coords.longitude, targetLat, targetLng);
                setText(`${d} km dari Anda`);
            },
            () => setText('Tidak bisa mendapatkan lokasi Anda.'),
            { enableHighAccuracy: true, timeout: 8000 }
        );
    })();

    // Booking qty & total calculator
    (function () {
        const card = document.querySelector('.booking-card[data-price]');
        if (!card) return;

        const basePrice = parseInt(card.dataset.price, 10) || 0;
        const qtyInput = document.getElementById('qty-input');
        const decBtn = document.getElementById('qty-dec');
        const incBtn = document.getElementById('qty-inc');
        const totalEl = document.getElementById('total-price');

        const formatIDR = (n) => `IDR ${n.toLocaleString('id-ID')}`;

        function clampQty(val) {
            const num = parseInt(val, 10);
            return Number.isFinite(num) && num > 0 ? num : 1;
        }

        function updateTotal() {
            const qty = clampQty(qtyInput.value);
            qtyInput.value = qty;
            const total = basePrice * qty;
            totalEl.textContent = formatIDR(total);
        }

        decBtn?.addEventListener('click', () => {
            qtyInput.value = Math.max(1, clampQty(qtyInput.value) - 1);
            updateTotal();
        });

        incBtn?.addEventListener('click', () => {
            qtyInput.value = clampQty(qtyInput.value) + 1;
            updateTotal();
        });

        qtyInput?.addEventListener('input', updateTotal);

        updateTotal();
    })();
