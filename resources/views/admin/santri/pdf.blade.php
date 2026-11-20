<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Santri - MI Tahfizh Al Furqon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0694a2;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #0694a2;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #0694a2;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        .status-badge {
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-menunggu_verifikasi {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-diverifikasi {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .status-diterima {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-ditolak {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Santri Baru</h1>
        <p>MI Tahfizh Al Furqon</p>
        <p>Tanggal: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Jenis Kelamin</th>
                <th>NISN</th>
                <th>Sekolah Asal</th>
                <th>Program</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>No HP/WA</th>
                <th>Status</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($santri as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $s->nama_lengkap }}</td>
                <td>{{ $s->jenis_kelamin ?? '-' }}</td>
                <td>{{ $s->nisn }}</td>
                <td>{{ $s->sekolah_asal }}</td>
                <td>{{ $s->program_pilihan ?? '-' }}</td>
                <td>{{ $s->orangTua->nama_ayah ?? '-' }}</td>
                <td>{{ $s->orangTua->nama_ibu ?? '-' }}</td>
                <td>{{ $s->orangTua->no_hp_wa ?? '-' }}</td>
                <td>
                    <span class="status-badge status-{{ $s->status }}">
                        @switch($s->status)
                            @case('menunggu_verifikasi')
                                Menunggu Verifikasi
                                @break
                            @case('diverifikasi')
                                Diverifikasi
                                @break
                            @case('diterima')
                                Diterima
                                @break
                            @case('ditolak')
                                Ditolak
                                @break
                        @endswitch
                    </span>
                </td>
                <td>{{ $s->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Data: {{ $santri->count() }} santri</p>
        <p>Dokumen ini diperbarui secara otomatis oleh sistem PPDB</p>
    </div>
</body>
</html>
