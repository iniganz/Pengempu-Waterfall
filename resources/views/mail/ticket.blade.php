<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tiket Resmi - {{ $order->order_id }}</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f7f7f7; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width:600px;margin:auto;background:#ffffff;border-radius:8px;border:1px solid #e5e5e5">

        {{-- HEADER --}}
        <tr>
            <td style="padding:24px;text-align:center;border-bottom:1px solid #e5e5e5">
                <h2 style="margin:0;color:#16a34a">🎟️ Tiket Resmi Anda</h2>
                <p style="margin:8px 0 0;color:#555">
                    Order ID: <strong>{{ $order->order_id }}</strong>
                </p>
                <p style="margin:4px 0 0;color:#777">
                    Kode Tiket: <strong>{{ $ticket->ticket_code }}</strong>
                </p>
            </td>
        </tr>

        {{-- CONTENT --}}
        <tr>
            <td style="padding:24px;color:#333">
                <p>Halo <strong>{{ $order->name }}</strong>,</p>

                <p>
                    Terima kasih telah melakukan pembayaran.
                    Berikut adalah <strong>tiket resmi</strong> Anda:
                </p>

                <table width="100%" cellpadding="6" cellspacing="0"
                    style="border-collapse:collapse;margin:16px 0">
                    <tr>
                        <td style="color:#666;width:40%">Destinasi</td>
                        <td style="font-weight:600">{{ $order->product->title }}</td>
                    </tr>
                    <tr>
                        <td style="color:#666">Tanggal Kunjungan</td>
                        <td style="font-weight:600">{{ $order->reserve_date }}</td>
                    </tr>
                    <tr>
                        <td style="color:#666">Jumlah Tiket</td>
                        <td style="font-weight:600">{{ $order->qty }} orang</td>
                    </tr>
                    <tr>
                        <td style="color:#666">Total Pembayaran</td>
                        <td style="font-weight:600;color:#16a34a">
                            IDR {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>

                <p style="margin-top:20px">
                    <strong>📌 Tunjukkan QR Code ini saat masuk lokasi:</strong>
                </p>

                {{-- QR CODE --}}
                <div style="text-align:center;margin:16px 0">
                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode(route('ticket.verify', $ticket->qr_token)) }}"
                        alt="QR Tiket"
                        style="max-width:260px;border:1px solid #e5e5e5;padding:8px"
                    >
                </div>

                <p style="font-size:14px;color:#555">
                    QR Code ini dapat di-scan oleh siapa saja untuk melihat detail tiket.
                    Namun, tiket hanya akan menjadi <strong>tidak valid</strong> jika divalidasi oleh pengelola lokasi.
                </p>

                <p style="margin-top:16px">
                    Sampai jumpa dan selamat menikmati kunjungan Anda 🌿
                </p>
            </td>
        </tr>

        {{-- FOOTER --}}
        <tr>
            <td style="padding:16px 24px;background:#f3f4f6;color:#777;text-align:center;font-size:13px">
                © {{ date('Y') }} Pengempu Waterfall<br>
                Email ini dikirim otomatis, mohon tidak dibalas
            </td>
        </tr>
    </table>
</body>
</html>
