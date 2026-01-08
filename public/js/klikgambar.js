
    document.addEventListener('DOMContentLoaded', function () {
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                // Ganti sumber gambar utama dengan sumber thumbnail yang diklik
                mainImage.src = this.src;

                // Tambahkan kelas 'active' pada thumbnail yang diklik
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
