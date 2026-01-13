<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🔍 Scan Tiket Pengunjung') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Instruksi -->
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start">
                            <div class="text-xl mr-3">ℹ️</div>
                            <div>
                                <strong class="text-blue-900">Mode Validasi:</strong>
                                <p class="text-blue-800 mt-1">Anda sedang dalam mode validasi pengelola. QR Code yang di-scan akan langsung divalidasi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk scan QR atau manual token -->
                    <form method="GET" action="{{ route('ticket.validate', ':token') }}" id="scanForm">
                        <div class="mb-6 space-y-3">
                            <label for="tokenInput" class="block text-sm font-semibold text-gray-700">
                                📱 Scan QR Code atau Masukkan Token
                            </label>
                            <input
                                type="text"
                                id="tokenInput"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Token akan muncul otomatis setelah scan atau ketik manual..."
                                autofocus
                            >

                            <!-- Buttons Section -->
                            <div class="flex flex-col gap-3">
                                <button
                                    type="button"
                                    id="submitBtn"
                                    class="w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-150"
                                >
                                    ✓ Validasi
                                </button>
                                <button
                                    type="button"
                                    id="cameraBtn"
                                    class="w-full px-4 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-150 flex items-center justify-center gap-2"
                                >
                                    <span>📷</span>
                                    <span>Buka Kamera</span>
                                </button>
                            </div>

                            <p class="text-xs text-gray-500 mt-2">
                                💡 <strong>Token</strong> = QR Code yang ter-encode (20-30 karakter)
                                <br>atau Buka Kamera untuk scan langsung
                            </p>
                        </div>
                    </form>

                    <!-- Camera Modal -->
                    <div id="cameraModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" style="display: none;">
                        <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Scan QR Code</h3>
                                    <button
                                        type="button"
                                        id="closeCamera"
                                        class="text-gray-500 hover:text-gray-700 text-2xl"
                                    >
                                        ✕
                                    </button>
                                </div>

                                <!-- Video Stream -->
                                <div id="cameraContainer" class="mb-4">
                                    <video
                                        id="cameraStream"
                                        autoplay
                                        playsinline
                                        class="w-full rounded-lg bg-black"
                                        style="max-height: 400px; object-fit: cover;"
                                    ></video>
                                </div>

                                <!-- Camera Info -->
                                <div class="text-sm text-gray-600 mb-4">
                                    <p>Arahkan kamera ke QR Code tiket pengunjung</p>
                                    <p id="scanStatus" class="mt-2 text-blue-600 font-semibold">Scanning...</p>
                                </div>

                                <!-- Close Button -->
                                <button
                                    type="button"
                                    id="stopCamera"
                                    class="w-full px-4 py-2 bg-gray-300 text-gray-900 font-semibold rounded-lg hover:bg-gray-400 transition duration-150"
                                >
                                    Tutup Kamera
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Info scanning -->
                    <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">📋 Informasi Scanning:</h3>
                        <ul class="text-sm text-gray-700 space-y-2">
                            <li><strong>Waktu Scan:</strong> <span id="scanTime">-</span></li>
                            <li><strong>Total Tiket Divalidasi Hari Ini:</strong> <span id="totalToday">-</span></li>
                            <li><strong>Pengelola:</strong> {{ auth()->user()->name }}</li>
                        </ul>
                    </div>

                    <!-- Recent validated tickets -->
                    <hr class="my-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">✅ Tiket Tervalidasi Terbaru</h3>
                    <div id="recentTickets" class="mb-6">
                        <p class="text-sm text-gray-500">Belum ada tiket yang divalidasi hari ini</p>
                    </div>

                    <!-- Help Section -->
                    <div class="mt-8 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">❓ Cara Menggunakan</h3>
                        <ol class="text-sm text-gray-700 space-y-2 list-decimal list-inside">
                            <li>Pastikan Anda sudah login sebagai pengelola</li>
                            <li>Gunakan device dengan camera atau barcode scanner</li>
                            <li>Arahkan ke QR Code tiket pengunjung</li>
                            <li>Sistem otomatis akan mengarahkan ke halaman validasi</li>
                            <li>Tiket akan dimark sebagai "sudah digunakan"</li>
                            <li>Pengunjung tidak bisa menggunakan tiket yang sama 2x</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tokenInput = document.getElementById('tokenInput');
        const submitBtn = document.getElementById('submitBtn');
        const scanForm = document.getElementById('scanForm');
        const cameraBtn = document.getElementById('cameraBtn');
        const cameraModal = document.getElementById('cameraModal');
        const closeCamera = document.getElementById('closeCamera');
        const stopCamera = document.getElementById('stopCamera');
        const cameraStream = document.getElementById('cameraStream');
        const scanStatus = document.getElementById('scanStatus');

        let stream = null;
        let scanning = false;

        // ===== CAMERA FUNCTIONS =====
        cameraBtn.addEventListener('click', function() {
            cameraModal.style.display = 'flex';
            startCamera();
        });

        closeCamera.addEventListener('click', function() {
            stopCameraStream();
            cameraModal.style.display = 'none';
        });

        stopCamera.addEventListener('click', function() {
            stopCameraStream();
            cameraModal.style.display = 'none';
        });

        async function startCamera() {
            try {
                const constraints = {
                    video: {
                        facingMode: 'environment', // Back camera
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }
                };

                stream = await navigator.mediaDevices.getUserMedia(constraints);
                cameraStream.srcObject = stream;
                scanning = true;
                scanStatus.textContent = '📱 Scanning... Arahkan ke QR Code';
                scanQRCode();
            } catch (error) {
                console.error('Camera error:', error);
                scanStatus.textContent = '❌ Error: ' + error.message;
                alert('Tidak bisa akses kamera. Pastikan Anda memberikan permission.');
            }
        }

        function stopCameraStream() {
            scanning = false;
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
        }

        function scanQRCode() {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            const checkQR = () => {
                if (!scanning) return;

                if (cameraStream.readyState === cameraStream.HAVE_ENOUGH_DATA) {
                    canvas.width = cameraStream.videoWidth;
                    canvas.height = cameraStream.videoHeight;
                    context.drawImage(cameraStream, 0, 0, canvas.width, canvas.height);

                    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height, {
                        inversionAttempts: 2,
                    });

                    if (code) {
                        // QR Code ditemukan!
                        const qrData = code.data;
                        console.log('QR Data:', qrData);

                        // Extract token dari URL
                        // URL format: https://yoursite.com/ticket/verify/TOKEN
                        // atau bisa langsung TOKEN saja
                        const token = extractToken(qrData);

                        if (token) {
                            scanning = false;
                            scanStatus.textContent = '✅ QR Code terdeteksi! ' + token;
                            tokenInput.value = token;

                            // Tutup modal dan auto-submit
                            setTimeout(() => {
                                stopCameraStream();
                                cameraModal.style.display = 'none';
                                // Bisa auto-submit atau biarkan user klik button
                                // submitBtn.click();
                            }, 500);
                        }
                    } else {
                        scanStatus.textContent = '📱 Scanning... Tidak ada QR ditemukan';
                    }
                }

                requestAnimationFrame(checkQR);
            };

            requestAnimationFrame(checkQR);
        }

        function extractToken(qrData) {
            // Jika QR data adalah URL
            if (qrData.includes('/ticket/verify/')) {
                const parts = qrData.split('/ticket/verify/');
                return parts[parts.length - 1];
            }
            // Jika QR data langsung token (misal copy-paste dari sistem lain)
            if (qrData.match(/^[a-zA-Z0-9]{20,}$/)) {
                return qrData;
            }
            // Fallback: gunakan qrData as-is
            return qrData;
        }

        // ===== FORM SUBMIT FUNCTIONS =====
        // Submit saat Enter ditekan
        tokenInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                submitBtn.click();
            }
        });

        // Submit button click
        submitBtn.addEventListener('click', function() {
            const token = tokenInput.value.trim();
            if (token) {
                // Ubah form action dengan token yang di-scan
                const action = scanForm.action.replace(':token', token);
                window.location.href = action;
            } else {
                alert('Silakan scan atau masukkan token terlebih dahulu');
                tokenInput.focus();
            }
        });

        // ===== INFO FUNCTIONS =====
        // Update waktu scan
        function updateScanTime() {
            const now = new Date();
            document.getElementById('scanTime').textContent = now.toLocaleString('id-ID');
        }
        updateScanTime();

        // Update setiap menit
        setInterval(updateScanTime, 60000);

        // Load recent tickets via AJAX (optional)
        loadRecentTickets();

        function loadRecentTickets() {
            // Bisa di-implement dengan endpoint untuk ambil tiket yang divalidasi hari ini
            // fetch('/api/recent-validated-tickets')
            //     .then(r => r.json())
            //     .then(data => updateRecentList(data))
        }
    });
    </script>
</x-app-layout>
