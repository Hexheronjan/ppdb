<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\OrangTua;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $query = Santri::with(['orangTua', 'user', 'angkatan']);

        // Search
        if ($request->search) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nisn', 'like', '%' . $request->search . '%')
                  ->orWhereHas('orangTua', function($q) use ($request) {
                      $q->where('nama_ayah', 'like', '%' . $request->search . '%')
                        ->orWhere('nama_ibu', 'like', '%' . $request->search . '%');
                  });
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by tahun_ajaran
        if ($request->tahun_ajaran) {
            $query->where('tahun_ajaran', $request->tahun_ajaran);
        }

        // Sort
        $query->orderBy('created_at', 'desc');

        $allSantri = $query->get();

        // Kelompokkan per tahun ajaran (desc)
        $grouped = $allSantri->groupBy(function($s) {
            return $s->tahun_ajaran ?: 'Belum Ditentukan';
        })->sortKeysDesc();

        // Semua tahun ajaran untuk filter dropdown
        $tahunList = Santri::distinct()->pluck('tahun_ajaran')->filter()->sort()->values();

        // Untuk pagination dan kompatibilitas lama, tetap sediakan $santri
        $santri = Santri::with(['orangTua', 'user'])
                        ->when($request->search, function($q) use ($request) {
                            $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                              ->orWhere('nisn', 'like', '%' . $request->search . '%')
                              ->orWhereHas('orangTua', function($qo) use ($request) {
                                  $qo->where('nama_ayah', 'like', '%' . $request->search . '%');
                              });
                        })
                        ->when($request->status, fn($q) => $q->where('status', $request->status))
                        ->when($request->tahun_ajaran, fn($q) => $q->where('tahun_ajaran', $request->tahun_ajaran))
                        ->orderBy('created_at', 'desc')
                        ->paginate(50);

        return view('admin.santri.index', compact('santri', 'grouped', 'tahunList'));
    }
    
    public function show($id)
    {
        $santri = Santri::with(['orangTua', 'user'])->findOrFail($id);
        return view('admin.santri.show', compact('santri'));
    }
    
    public function edit($id)
    {
        $santri = Santri::with(['orangTua'])->findOrFail($id);
        return view('admin.santri.edit', compact('santri'));
    }
    
    public function update(Request $request, $id)
    {
        $santri = Santri::with('orangTua')->findOrFail($id);

        $request->validate([
            // Santri
            'nama_lengkap'        => 'required|string|max:255',
            'jenis_kelamin'       => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'        => 'required|string|max:255',
            'tanggal_lahir'       => 'required|date',
            'nisn'                => 'required|digits:10|unique:santri,nisn,' . $id,
            'sekolah_asal'        => 'required|string|max:255',
            'nsm'                 => 'required|numeric',
            'npsn'                => 'required|numeric',
            'alamat_sekolah_asal' => 'required|string',
            'program_pilihan'     => 'required|in:Program Khusus,Bina Prestasi',
            'info_ppdb'           => 'required|in:Media Sosial,Website,Teman/Keluarga,Alumni,Spanduk/Brosur,Lainnya',
            'status'              => 'required|in:menunggu_verifikasi,diverifikasi,diterima,ditolak',
            // Orang Tua
            'nama_ayah'           => 'required|string|max:255',
            'nama_ibu'            => 'required|string|max:255',
            'no_hp_wa'            => ['required', 'string', 'regex:/^(08|628|\\+628)[0-9]{8,13}$/'],
            'alamat'              => 'required|string',
        ]);

        // Normalize WA number
        $noHpWa = $request->no_hp_wa;
        $noHpWa = preg_replace('/^\+/', '', $noHpWa);
        if (preg_match('/^08/', $noHpWa)) {
            $noHpWa = '62' . substr($noHpWa, 1);
        }

        // Update Santri fields
        $santri->update([
            'nama_lengkap'        => $request->nama_lengkap,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'tempat_lahir'        => $request->tempat_lahir,
            'tanggal_lahir'       => $request->tanggal_lahir,
            'nisn'                => $request->nisn,
            'sekolah_asal'        => $request->sekolah_asal,
            'nsm'                 => $request->nsm,
            'npsn'                => $request->npsn,
            'alamat_sekolah_asal' => $request->alamat_sekolah_asal,
            'program_pilihan'     => $request->program_pilihan,
            'info_ppdb'           => $request->info_ppdb,
            'status'              => $request->status,
        ]);

        // Update OrangTua fields
        if ($santri->orangTua) {
            $santri->orangTua->update([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu'  => $request->nama_ibu,
                'no_hp_wa'  => $noHpWa,
                'alamat'    => $request->alamat,
            ]);
        }

        return redirect()->route('admin.santri.show', $santri->id)
            ->with('success', 'Data santri berhasil diperbarui.');
    }
    
    public function updateStatus(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);
        $santri->update(['status' => $request->status]);
        
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui'
        ]);
    }
    
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        
        $orangTuaId = $santri->orang_tua_id;
        
        $santri->delete();
        
        if ($orangTuaId) {
            OrangTua::where('id', $orangTuaId)->delete();
        }
        
        return redirect()->route('admin.santri.index')
            ->with('success', 'Data santri berhasil dihapus beserta data orang tua');
    }
    
    public function pollLatest()
    {
        $latest = \App\Models\Santri::orderBy('id', 'desc')->first(['id', 'created_at']);
        $total  = \App\Models\Santri::count();

        return response()->json([
            'latest_id' => $latest ? $latest->id : 0,
            'total'     => $total,
        ]);
    }

    public function exportExcel()
    {
        $santri = Santri::with(['orangTua'])->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="santri_' . date('Y-m-d') . '.csv"',
        ];
        
        $callback = function() use ($santri) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Nama Santri', 'Jenis Kelamin', 'NISN', 'Sekolah Asal', 'Program Pilihan', 'Nama Ayah', 'Nama Ibu', 'No HP/WA', 'Status', 'Tanggal Daftar']);
            
            foreach ($santri as $index => $s) {
                fputcsv($file, [
                    $index + 1,
                    $s->nama_lengkap,
                    $s->jenis_kelamin,
                    $s->nisn,
                    $s->sekolah_asal,
                    $s->program_pilihan,
                    $s->orangTua->nama_ayah ?? '-',
                    $s->orangTua->nama_ibu ?? '-',
                    $s->orangTua->no_hp_wa ?? '-',
                    $s->status,
                    $s->created_at->format('d/m/Y')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    public function exportPDF()
    {
        $santri = Santri::with(['orangTua'])->get();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.santri.pdf', compact('santri'));
        
        return $pdf->download('santri_' . date('Y-m-d') . '.pdf');
    }

    public function exportSinglePDF($id)
    {
        $santri = Santri::with(['orangTua'])->findOrFail($id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.santri.single_pdf', compact('santri'));
        
        $fileName = 'Formulir_' . \Str::slug($santri->nama_lengkap) . '_' . date('Ymd') . '.pdf';
        
        return $pdf->download($fileName);
    }
}
