
document.querySelector(".php-email-form").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    document.querySelector(".loading").style.display = "block";
    document.querySelector(".error-message").style.display = "none";
    document.querySelector(".sent-message").style.display = "none";

    fetch("php/kontak.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.querySelector(".loading").style.display = "none";
        if (data.status === "success") {
            document.querySelector(".sent-message").innerText = data.message;
            document.querySelector(".sent-message").style.display = "block";
            form.reset();
        } else {
            document.querySelector(".error-message").innerText = data.message;
            document.querySelector(".error-message").style.display = "block";
        }
    })
    .catch(error => {
        document.querySelector(".loading").style.display = "none";
        document.querySelector(".error-message").innerText = "Terjadi kesalahan saat mengirim pesan.";
        document.querySelector(".error-message").style.display = "block";
    });
});

