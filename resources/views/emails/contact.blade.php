<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesan Kontak</title>
</head>
<body>
    <h2>Pesan Baru dari Website</h2>

    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>

    @if(!empty($data['subject']))
        <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>
    @endif

    <hr>

    <p>{{ $data['message'] }}</p>
</body>
</html>
