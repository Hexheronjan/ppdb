<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pendaftaran #{{ $submissionId }}</title>
    <style>
        @page {
            margin: 100px 50px 80px 50px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 60px;
            text-align: center;
            line-height: 1.2;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .image {
            margin-bottom: 10px;
        }

        .lampiran-title {
            font-weight: bold;
            margin-top: 30px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <header>
        <h2>{{ $school->name ?? 'Nama Sekolah' }}</h2>
        <p>
            {{ $school->address ?? 'Alamat belum diatur' }}<br>
            Telp: {{ $school->phone ?? '-' }} | Email: {{ $school->email ?? '-' }}
        </p>
    </header>

    <footer>
        <p>Dokumen ini dihasilkan secara otomatis - {{ date('d-m-Y H:i') }} | Halaman: <span class="page"></span></p>
    </footer>

    <main>
        <h3 style="text-align: center; margin-bottom: 20px;">Detail Pendaftaran #{{ $submissionId }}</h3>

        <table>
            <thead>
                <tr>
                    <th>Informasi</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fields as $field)
                    @if (!$field->file_path)
                        <tr>
                            <td>{{ $field->field_name }}</td>
                            <td>{{ $field->value }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        @php $attachments = $fields->filter(fn($f) => $f->file_path); @endphp
        @if ($attachments->count())
            <h3 class="lampiran-title">Lampiran</h3>
            @foreach ($attachments as $field)
                <div class="image">
                    <p><strong>{{ $field->field_name }}</strong></p>
                    <img src="{{ public_path('storage/' . $field->file_path) }}" width="300" alt="{{ $field->field_name }}">
                </div>
            @endforeach
        @endif
    </main>
</body>
</html>
