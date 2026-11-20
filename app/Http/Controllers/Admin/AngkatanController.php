<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Angkatan;

class AngkatanController extends Controller
{
    public function index()
    {
        $angkatan = Angkatan::withCount('santri')
                            ->orderBy('tahun_ajaran', 'desc')
                            ->get();
        return view('admin.angkatan.index', compact('angkatan'));
    }

    public function create()
    {
        return view('admin.angkatan.create');
    }

    public function store(Request $request)
    {
        $this->validateSchedule($request);

        Angkatan::create([
            'nama_angkatan'        => $request->nama_angkatan,
            'tahun_ajaran'         => $request->tahun_ajaran,
            'tanggal_mulai_daftar' => $request->tanggal_mulai_daftar,
            'tanggal_tutup_daftar' => $request->tanggal_tutup_daftar,
            'jam_mulai_daftar'     => $request->jam_mulai_daftar,
            'jam_tutup_daftar'     => $request->jam_tutup_daftar,
            'is_active'            => $request->boolean('is_active', true),
            'keterangan'           => $request->keterangan,
        ]);

        return redirect()->route('admin.angkatan.index')
                         ->with('success', 'Angkatan berhasil ditambahkan.');
    }

    private function validateSchedule(Request $request): void
    {
        // Normalisasi nilai TIME dari data lama MySQL (HH:MM:SS) ke format input HTML (HH:MM).
        $request->merge([
            'jam_mulai_daftar' => substr((string) $request->input('jam_mulai_daftar'), 0, 5),
            'jam_tutup_daftar' => substr((string) $request->input('jam_tutup_daftar'), 0, 5),
        ]);

        $request->validate([
            'nama_angkatan'        => 'required|string|max:255',
            'tahun_ajaran'         => 'required|string|max:20',
            'tanggal_mulai_daftar' => 'required|date',
            'tanggal_tutup_daftar' => 'required|date|after_or_equal:tanggal_mulai_daftar',
            'jam_mulai_daftar'     => 'required|date_format:H:i,H:i:s',
            'jam_tutup_daftar'     => 'required|date_format:H:i,H:i:s',
            'keterangan'           => 'nullable|string|max:500',
        ], [
            'tanggal_tutup_daftar.after_or_equal' => 'Tanggal tutup tidak boleh sebelum tanggal buka.',
            'jam_mulai_daftar.date_format' => 'Jam buka tidak valid.',
            'jam_tutup_daftar.date_format' => 'Jam tutup tidak valid.',
        ]);

        if ($request->tanggal_mulai_daftar === $request->tanggal_tutup_daftar
            && $request->jam_tutup_daftar <= $request->jam_mulai_daftar) {
            throw ValidationException::withMessages([
                'jam_tutup_daftar' => 'Jam tutup harus setelah jam buka apabila tanggalnya sama.',
            ]);
        }
    }

    public function edit($id)
    {
        $angkatan = Angkatan::findOrFail($id);
        return view('admin.angkatan.edit', compact('angkatan'));
    }

    public function update(Request $request, $id)
    {
        $angkatan = Angkatan::findOrFail($id);

        $this->validateSchedule($request);

        $angkatan->update([
            'nama_angkatan'        => $request->nama_angkatan,
            'tahun_ajaran'         => $request->tahun_ajaran,
            'tanggal_mulai_daftar' => $request->tanggal_mulai_daftar,
            'tanggal_tutup_daftar' => $request->tanggal_tutup_daftar,
            'jam_mulai_daftar'     => $request->jam_mulai_daftar,
            'jam_tutup_daftar'     => $request->jam_tutup_daftar,
            'is_active'            => $request->boolean('is_active'),
            'keterangan'           => $request->keterangan,
        ]);

        return redirect()->route('admin.angkatan.index')
                         ->with('success', 'Data angkatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $angkatan = Angkatan::withCount('santri')->findOrFail($id);

        if ($angkatan->santri_count > 0) {
            return redirect()->route('admin.angkatan.index')
                             ->with('error', 'Angkatan tidak bisa dihapus karena masih memiliki ' . $angkatan->santri_count . ' data santri.');
        }

        $angkatan->delete();
        return redirect()->route('admin.angkatan.index')
                         ->with('success', 'Angkatan berhasil dihapus.');
    }
}
