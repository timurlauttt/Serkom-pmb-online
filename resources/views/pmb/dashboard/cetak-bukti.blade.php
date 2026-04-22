<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 6px 4px;
            vertical-align: top;
        }

        .label {
            width: 30%;
            font-weight: bold;
        }

        .separator {
            width: 5%;
        }

        .value {
            width: 65%;
        }

        .status {
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #000;
            text-align: center;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .signature {
            width: 40%;
            text-align: center;
            float: right;
        }

        .signature .space {
            height: 60px;
        }

        .note {
            margin-top: 20px;
            font-size: 10px;
            font-style: italic;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <div class="header">
            <h2>SMK TAMANSISWA PURWOKERTO</h2>
            <p>Jl. Sunan Ampel, Dusun IV, Kedungmalang, Kec. Sumbang, Kabupaten Banyumas, Jawa Tengah 53183</p>
            <p>Email: smktamansiswapurwokerto@gmail.com | Telp: +62 813-2887-7238</p>
        </div>

        <!-- TITLE -->
        <div class="title">
            BUKTI PENDAFTARAN SISWA BARU
        </div>

        <!-- DATA -->
        <table class="info-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="separator">:</td>
                <td class="value">{{ $casis->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td class="separator">:</td>
                <td class="value">{{ $casis->email ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">No HP</td>
                <td class="separator">:</td>
                <td class="value">{{ $casis->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="separator">:</td>
                <td class="value">{{ $casis->alamat_saat_ini ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kecamatan</td>
                <td class="separator">:</td>
                <td class="value">{{ $casis->kecamatan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kabupaten/Kota</td>
                <td class="separator">:</td>
                <td class="value">{{ $casis->kabupaten?->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Provinsi</td>
                <td class="separator">:</td>
                <td class="value">{{ $casis->provinsi?->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Daftar</td>
                <td class="separator">:</td>
                <td class="value">{{ $casis->created_at->format('d-m-Y') }}</td>
            </tr>
        </table>

        <!-- STATUS -->
        <div class="status">
            STATUS PENDAFTARAN:
            {{ strtoupper($casis->status_penerimaan ?? 'SEDANG DIPROSES') }}
        </div>

        <!-- FOOTER / TTD -->
        <div class="footer">
            <div class="signature">
                <p>Purwokerto, {{ now()->format('d-m-Y') }}</p>
                <p>Panitia PPDB</p>

                <div class="space"></div>

                <p><strong>____________________</strong></p>
            </div>
        </div>

        <!-- NOTE -->
        <div class="note">
            * Dokumen ini adalah bukti resmi pendaftaran. Harap dibawa saat proses verifikasi.
        </div>

    </div>

</body>

</html>
