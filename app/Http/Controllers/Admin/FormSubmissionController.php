<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormSubmission;
use App\Models\FormGroup;
use App\Models\School;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

class FormSubmissionController extends Controller
{
    public function index()
    {
        $schools = School::find(1); // Ambil sekolah dengan ID tertentu

        $nama_sekolah = $schools->name ?? 'Sekolah Tidak Ditemukan';
        // Ambil semua form groups
        $formGroups = FormGroup::all();

        // Hitung total form submissions per group berdasarkan kondisi id_user dan submission_id
        foreach ($formGroups as $group) {
            $group->submission_count = DB::table('form_submissions')
                ->where('form_group_id', $group->id_form) // Hubungan ke grup
                ->select('submission_id') // Kelompokkan berdasarkan submission_id
                ->whereNotNull('user_id') // Hanya jika id_user ada
                ->distinct() // Hitung hanya submission_id unik
                ->count('submission_id');
        }

        return view('admin.form_submission.index', compact('formGroups', 'schools', 'nama_sekolah'));
    }
    
    // Menampilkan daftar submission berdasarkan group
    public function submissionsByGroup($formGroupId)
    {
        $formGroup = FormGroup::findOrFail($formGroupId);

        $submissions = FormSubmission::where('form_group_id', $formGroupId)
            ->get()
            ->groupBy('submission_id');

        return view('admin.form_submission.by_group', compact('formGroup', 'submissions'));
    }

    // Menampilkan detail submission berdasarkan SubmissionId
    public function submissionDetail($submissionId)
    {
        $formGroupId = FormSubmission::where('submission_id', $submissionId)->value('form_group_id');
        $formGroups = FormGroup::all();

        // Ambil semua field kecuali "form group id"
        $fields = FormSubmission::where('submission_id', $submissionId)
            ->whereRaw("LOWER(field_name) != 'form group id'")
            ->get();

        return view('admin.form_submission.detail_submission', compact(
            'fields', 'submissionId', 'formGroups', 'formGroupId'
        ));
    }
    

    public function updateStatus(Request $request, $submissionId)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        FormSubmission::where('submission_id', $submissionId)
            ->update(['status' => $request->status]);

        $firstField = FormSubmission::where('submission_id', $submissionId)->first();

        if ($firstField && $firstField->user) {
            $user = $firstField->user;
            $phone = $user->no_wa;
            $name = $user->name;
            $fields = FormSubmission::where('submission_id', $submissionId)->get();

            $this->sendWhatsapp($phone, $name, $request->status, $submissionId, $fields);
        }

        return redirect()
            ->route('admin.form_submission.detail_submission', $submissionId)
            ->with('success', 'Status berhasil diperbarui dan notifikasi dikirim.');
    }

    private function sendWhatsapp($nomorWA, $userName, $status, $submissionId, $fields)
    {
        $apiKey = env('ONESENDER_API_KEY');
        $apiUrl = env('ONESENDER_API_URL');

        // Format nomor ke internasional
        $nomorWA = "+" . preg_replace('/^0/', '62', trim($nomorWA));

        // Buat informasi data pendaftar
        $info = "";
        foreach ($fields as $field) {
            if (!$field->file_path && strtolower($field->field_name) != 'form group id') {
                $info .= "*{$field->field_name}:* {$field->value}\n";
            }
        }

        // Buat isi pesan berdasarkan status
        $statusMessage = match ($status) {
            'diterima' => "Selamat! Pendaftaran Anda telah *DITERIMA*.",
            'ditolak' => "Mohon maaf, pendaftaran Anda telah *DITOLAK*.",
            default => "Status pendaftaran Anda saat ini adalah *PENDING*.",
        };

        $message = "*Konfirmasi Pendaftaran PPDB*\n\n"
                . "Halo *{$userName}*,\n\n"
                . "{$statusMessage}\n\n"
                . "*ID Pendaftaran:* {$submissionId}\n"
                . "{$info}\n"
                . "_Pesan ini dikirim otomatis oleh sistem PPDB Sekolah._";

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                "recipient_type" => "individual",
                "to" => $nomorWA,
                "type" => "text",
                "text" => [
                    "body" => $message
                ]
            ]);

            \Log::info("WA konfirmasi pendaftaran terkirim ke $nomorWA", [
                'response' => $response->json()
            ]);
        } catch (\Exception $e) {
            \Log::error("Gagal kirim WA konfirmasi", [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function downloadPdf($submissionId)
    {
        $formGroupId = FormSubmission::where('submission_id', $submissionId)->value('form_group_id');

        $fields = FormSubmission::where('submission_id', $submissionId)
            ->whereRaw("LOWER(field_name) != 'form group id'")
            ->get();

        $school = School::first(); // Ambil data sekolah pertama

        $pdf = PDF::loadView('admin.form_submission.pdf', compact('fields', 'submissionId', 'school'))
                ->setPaper('A4', 'portrait');

        return $pdf->download('detail_pendaftaran_'.$submissionId.'.pdf');
    }

    // public function showSubmissionsByGroup($formGroupId)
    // {
    //     // Ambil form group beserta submissionsnya
    //     $formGroup = FormGroup::with(['submissions' => function ($query) {
    //         $query->groupBy('submission_id');
    //     }])->findOrFail($formGroupId);

    //     return view('admin.form_submission.by_group', compact('formGroup'));
    // }

}
