<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: 20px 30px;
        }

        .header {
            margin-bottom: 35px;
        }

        .logo {
            width: 120px;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: -60px;
            text-transform: uppercase;
        }

        .meta {
            margin-top: 20px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .right {
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
        }
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
                <th width="4%">No</th>
                <th width="18%">Nama Arsip</th>
                <th width="12%">Kode Arsip</th>
                <th width="10%">Divisi</th>
                <th width="12%">Kode Klasifikasi</th>
                <th width="10%">Nominal</th>
                <th width="10%">No SPBy</th>
                <th width="10%">No SPM</th>
                <th width="8%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengajuan as $i => $item)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $item->archive_name }}</td>
                    <td class="center">{{ $item->archive_code }}</td>
                    <td class="center">{{ $item->from_division }}</td>
                    <td class="center">{{ $item->kode_klasifikasi }}</td>
                    <td class="right">
                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                    </td>
                    <td class="center">{{ $item->no_spby ?? '-' }}</td>
                    <td class="center">{{ $item->no_spm ?? '-' }}</td>
                    <td class="center">{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="center">
                        Tidak ada data arsip aktif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- FOOTER / TANDA TANGAN --}}
    <div class="footer">
        <table width="100%" style="border: none; margin-top: 50px;">
            <tr>
                <td width="65%"></td>
                <td width="35%" style="text-align: center;">
                    <p>
                        {{ now()->format('d M Y') }}<br>
                        Kepala Kantor
                    </p>

                    <br><br><br><br>

                    <strong>
                        {{ Auth::user()->name }}
                    </strong><br>
                    <span style="font-size: 10px;">
                        {{ Auth::user()->role }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>