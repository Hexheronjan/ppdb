<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulir Pendaftaran - {{ $santri->nama_lengkap }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.6; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 24px; border-bottom: 3px solid #0694a2; padding-bottom: 16px; }
        .header h1 { color: #0694a2; margin: 0 0 4px; font-size: 20px; }
        .header p { margin: 2px 0; color: #555; font-size: 11px; }
        .section { margin-bottom: 20px; }
        .section-title { background-color: #0694a2; color: white; padding: 6px 12px; font-weight: bold; font-size: 12px; margin-bottom: 0; }
        .section-body { border: 1px solid #ddd; padding: 12px; }
        .row { display: flex; margin-bottom: 8px; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data td { padding: 6px 8px; vertical-align: top; }
        table.data td:first-child { width: 40%; color: #666; font-weight: bold; }
        table.data td:last-child { width: 60%; }
        .status-badge { display: inline-block; padding: 3px 10px; border-radius: 10px; font-size: 11px; font-weight: bold; }
        .status-menunggu_verifikasi { background-color: #fef3c7; color: #92400e; }
        .status-diverifikasi { background-color: #dbeafe; color: #1e40af; }
        .status-diterima { background-color: #d1fae5; color: #065f46; }
        .status-ditolak { background-color: #fee2e2; color: #991b1b; }
        .footer { margin-top: 30px; text-align: center; color: #999; font-size: 10px; border-top: 1px solid #eee; padding-top: 10px; }
        .badge-program { display: inline-block; padding: 2px 8px; background: #e0f2fe; color: #0284c7; border-radius: 6px; font-size: 11px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Formulir Pendaftaran Peserta Didik Baru</h1>
        <p>PPDB - MI Tahfizh Al Furqon</p>
        <p>Tahun Ajaran: {{ $santri->tahun_ajaran ?? '-' }} &nbsp;|&nbsp; Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <div class="section-title">A. Data Calon Peserta Didik</div>
        <div class="section-body">
            <table class="data">
                <tr><td>Nama Lengkap</td><td>{{ $santri->nama_lengkap }}</td></tr>
                <tr><td>Jenis Kelamin</td><td>{{ $santri->jenis_kelamin ?? '-' }}</td></tr>
                <tr><td>Tempat, Tanggal Lahir</td><td>{{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir?->format('d/m/Y') }}</td></tr>
                <tr><td>NISN</td><td>{{ $santri->nisn }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">B. Data Asal Sekolah</div>
        <div class="section-body">
            <table class="data">
                <tr><td>Nama TK/RA Asal</td><td>{{ $santri->sekolah_asal }}</td></tr>
                <tr><td>NSM Sekolah Asal</td><td>{{ $santri->nsm ?? '-' }}</td></tr>
                <tr><td>NPSN Sekolah Asal</td><td>{{ $santri->npsn ?? '-' }}</td></tr>
                <tr><td>Alamat Sekolah Asal</td><td>{{ $santri->alamat_sekolah_asal ?? '-' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">C. Data Orang Tua / Wali</div>
        <div class="section-body">
            <table class="data">
                <tr><td>Nama Ayah</td><td>{{ $santri->orangTua->nama_ayah ?? '-' }}</td></tr>
                <tr><td>Nama Ibu</td><td>{{ $santri->orangTua->nama_ibu ?? '-' }}</td></tr>
                <tr><td>Nomor HP / WhatsApp</td><td>{{ $santri->orangTua->no_hp_wa ?? '-' }}</td></tr>
                <tr><td>Alamat</td><td>{{ $santri->orangTua->alamat ?? '-' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">D & E. Pilihan Program & Informasi Tambahan</div>
        <div class="section-body">
            <table class="data">
                <tr><td>Program Pilihan</td><td>{{ $santri->program_pilihan ?? '-' }}</td></tr>
                <tr><td>Mengetahui PPDB dari</td><td>{{ $santri->info_ppdb ?? '-' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Status Pendaftaran</div>
        <div class="section-body" style="text-align:center; padding: 16px;">
            <span class="status-badge status-{{ $santri->status }}">
                @switch($santri->status)
                    @case('menunggu_verifikasi') Menunggu Verifikasi @break
                    @case('diverifikasi') Diverifikasi @break
                    @case('diterima') Diterima @break
                    @case('ditolak') Ditolak @break
                @endswitch
            </span>
            <p style="color:#666; margin-top: 6px; font-size:11px;">Tanggal Pendaftaran: {{ $santri->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh sistem PPDB</p>
    </div>
</body>
</html>