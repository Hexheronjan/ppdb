<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header, .footer { text-align: center; }
        .header h2 { margin: 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #999; padding: 8px; text-align: left; }
        .status { margin-top: 20px; padding: 10px; font-weight: bold; }
        .status.diterima { background-color: #c6f6d5; color: #22543d; }
        .status.ditolak { background-color: #fed7d7; color: #742a2a; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h2>{{ $schools->name }}</h2>
        <p>{{ $schools->address }} | Telp: {{ $schools->phone }}</p>
        <hr>
    </div>

    <!-- Judul -->
    <h3 style="text-align:center;">Bukti Pendaftaran PPDB</h3>
    <p><strong>Periode:</strong> {{ $form->academic_year }}</p>
    <p><strong>Nomor Pendaftaran:</strong> {{ $submissionId }}</p>
    <p><strong>Tanggal Pendaftaran:</strong> 
        {{ $registration_date ? \Carbon\Carbon::parse($registration_date)->translatedFormat('d F Y') : '-' }}
    </p>

    <!-- Status -->
    <div class="status {{ $status }}">
        Status: {{ strtoupper($status) }}
    </div>

    <!-- Data Pendaftar -->
    <table class="table">
        <thead>
            <tr>
                <th>Informasi</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fields as $field)
                <tr>
                    <td>{{ $field->file_path ? 'Lampiran - ' . $field->field_name : $field->field_name }}</td>
                    <td>
                        @if ($field->file_path)
                            <img 
                                src="{{ public_path('storage/' . $field->file_path) }}" 
                                alt="{{ $field->field_name }}" 
                                style="width: 100px; height: 100px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;">
                        @else
                            {{ $field->value }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <hr>
        <p>Dokumen ini dicetak otomatis dari sistem PPDB</p>
    </div>

</body>
</html>
