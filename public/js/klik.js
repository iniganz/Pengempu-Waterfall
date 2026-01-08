document.addEventListener("contextmenu", function(event) {
    event.preventDefault(); // Mencegah klik kanan
    showToast("Klik kanan dicegah!");
});

document.addEventListener("keydown", function(event) {
    // Mencegah F12, Ctrl+Shift+I, dan Ctrl+U
    if (event.key === "F12" || 
        (event.ctrlKey && event.shiftKey && event.key === "I") || 
        (event.ctrlKey && event.key === "U")) {
        event.preventDefault();
        showToast("Dilarang inspect element!");
    }
});

// Fungsi untuk menampilkan toast notification
function showToast(message) {
    let toast = document.getElementById("toast");
    if (toast) {
        toast.innerText = message;
        toast.classList.add("show");
        setTimeout(() => {
            toast.classList.remove("show");
        }, 2000);
    } else {
        console.error("Element toast tidak ditemukan!");
    }
}

(function() {
    let devtoolsOpen = false;
    let threshold = 160; // Ukuran minimum untuk mendeteksi Console

    setInterval(function() {
        let widthThreshold = window.outerWidth - window.innerWidth > threshold;
        let heightThreshold = window.outerHeight - window.innerHeight > threshold;
        if (widthThreshold || heightThreshold) {
            document.body.style.filter = "blur(10px)";
            devtoolsOpen = true;
        } else if (devtoolsOpen) {
            document.body.style.filter = "none";
            devtoolsOpen = false;
        }
    }, 500);
})();


(function() {
    function checkDevTools() {
        let before = new Date();
        debugger; // Jika Developer Tools dibuka, ini akan memperlambat eksekusi
        let after = new Date();
        if (after - before > 100) {
            alert("Developer Tools terdeteksi! Halaman akan ditutup.");
            window.close(); // Menutup tab
        }
    }
    setInterval(checkDevTools, 1000); // Cek setiap 1 detik
})();