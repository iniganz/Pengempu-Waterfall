
document.addEventListener('DOMContentLoaded', function () {
    const mainImage = document.getElementById('mainImage');

    if (!mainImage) {
        console.error('Main image tidak ditemukan');
        return;
    }

    document.querySelectorAll('.thumb img').forEach(img => {
        img.addEventListener('click', function () {
            const newSrc = this.src;

            if (!newSrc) {
                console.error('SRC thumbnail kosong');
                return;
            }

            // Ganti gambar utama
            mainImage.style.opacity = 0;
            setTimeout(() => {
                mainImage.src = newSrc;
                mainImage.style.opacity = 1;
            }, 150);

            // Active state
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            this.closest('.thumb').classList.add('active');
        });
    });
});
