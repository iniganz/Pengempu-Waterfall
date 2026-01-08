
    // Simpan posisi scroll sebelum reload
    window.addEventListener("beforeunload", function () {
        localStorage.setItem("scrollY", window.scrollY);
    });

    // Kembalikan posisi scroll setelah reload
    window.addEventListener("load", function () {
        const scrollY = localStorage.getItem("scrollY");
        if (scrollY !== null) {
            window.scrollTo(0, parseInt(scrollY));
        }
    });

