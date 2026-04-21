<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .header {
            margin-bottom: 40px;
        }

        .logo {
            width: 120px;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: -60px;
        }

        .meta {
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }

        th {
            background: #f0f0f0;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 45px;
            width: 100%;
            clear: both;
        }

        .signature {
            width: 35%;
            text-align: center;
            float: right;
        }

        /* ❌ watermark DIMATIKAN TOTAL */
    </style>
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <img src="{{ $watermark }}" class="logo">

    <div class="title">
        {{ $title }}
    </div>
</div>

{{-- PERIODE --}}
<div class="meta">
    <strong>Periode:</strong>
    {{ \Carbon\Carbon::parse($tanggal_awal)->format('d M Y') }}
    s/d
    {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d M Y') }}
</div>

{{-- TABLE --}}
<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="30%">Nama Arsip</th>
            <th width="20%">Kode Klasifikasi</th>
            <th width="15%">No SPBy</th>
            <th width="15%">No SPM</th>
            <th width="15%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pengajuan as $i => $item)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $item->archive_name }}</td>
                <td class="center">{{ $item->kode_klasifikasi }}</td>
                <td class="center">{{ $item->no_spby ?? '-' }}</td>
                <td class="center">{{ $item->no_spm ?? '-' }}</td>
                <td class="center"><strong>Disetujui</strong></td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="center">
                    Tidak ada data arsip
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- TTD --}}
<div class="footer">
    <div class="signature">
        <p>
            {{ now()->format('d M Y') }}<br>
            Kepala Kantor
        </p>

        <br><br>

        <img src="{{ storage_path('app/public/images/ttd_kepala.png') }}" width="120">

        <br><br>

        <strong>{{ Auth::user()->name }}</strong><br>
        {{ Auth::user()->role }}
    </div>
</div>

</body>
</html>