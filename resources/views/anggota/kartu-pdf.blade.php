<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif
        }

        .card {
            width: 520px;
            margin: 30px auto;
            background: #0F5132;
            color: white;
            border-radius: 24px;
            padding: 28px
        }

        .gold {
            color: #D4AF37
        }

        .box {
            background: rgba(255, 255, 255, .12);
            padding: 18px;
            border-radius: 18px;
            margin-top: 20px
        }

        .qr {
            background: white;
            color: #111;
            padding: 12px;
            border-radius: 12px;
            text-align: center;
            margin-top: 20px
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Kartu Anggota Pagar Nusa</h1>
        <p class="gold">SIGAPN Digital Card</p>
        <div class="box">
            <h2>{{ $anggota->nama_lengkap }}</h2>
            <p>{{ $anggota->nia }}</p>
            <p>{{ $anggota->kampus?->nama_kampus }}</p>
            <p>Sabuk: {{ $anggota->tingkatan_sabuk }}</p>
        </div>
        <div class="qr">{!! $qr !!}
            <p>Verifikasi QR Code</p>
        </div>
    </div>
</body>

</html>