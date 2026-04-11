<?php

namespace App\Http\Controllers;

use App\Models\EmailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmailRequestController extends Controller
{
    public function index()
    {
        $emailRequest = EmailRequest::all();
        return view('email-request', compact('emailRequest'));
    }

    public function create()
    {
        return view('email-request-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'opd_id' => 'required|exists:opds,id',
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email_pribadi' => 'nullable|email',
            'nama_email_diusulkan' => 'required|string|max:100',
            'domain' => 'required|string|max:100',
            'alasan_permohonan' => 'required',
            'surat_permohonan' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::transaction(function () use ($request, $validated) {

            // Upload file
            $filePath = $request->file('surat_permohonan')
                ->store('surat_permohonan', 'public');

            // Simpan data
            EmailRequest::create([
                ...$validated,
                'user_id' => auth()->id(),
                'surat_permohonan' => $filePath,
                'status' => 'diajukan',
            ]);
        });

        return redirect()->back()->with('success', 'Permintaan berhasil diajukan');
    }

    public function edit(EmailRequest $emailRequest)
    {
        return view('email-request-edit', compact('emailRequest'));
    }

    public function update(Request $request, EmailRequest $emailRequest)
    {
        $validated = $request->validate([
            'opd_id' => 'required|exists:opds,id',
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email_pribadi' => 'nullable|email',
            'nama_email_diusulkan' => 'required|string|max:100',
            'domain' => 'required|string|max:100',
            'alasan_permohonan' => 'required',
            'surat_permohonan' => 'nullable|file|mimes:pdf|max:2048',
            'status' => 'required|in:draft,diajukan,diverifikasi,ditolak,disetujui,selesai',
        ]);

        DB::transaction(function () use ($request, $validated, $emailRequest) {

            // Jika upload file baru
            if ($request->hasFile('surat_permohonan')) {
                $filePath = $request->file('surat_permohonan')
                    ->store('surat_permohonan', 'public');

                $validated['surat_permohonan'] = $filePath;
            }

            // Tambahan logic jika status berubah
            if ($validated['status'] === 'diverifikasi') {
                $validated['tanggal_verifikasi'] = now();
                $validated['diproses_oleh'] = auth()->id();
            }

            if ($validated['status'] === 'selesai') {
                $validated['tanggal_selesai'] = now();
            }

            $emailRequest->update($validated);
        });

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(EmailRequest $emailRequest)
    {
        DB::transaction(function () use ($emailRequest) {

            // Hapus file jika ada
            if (
                $emailRequest->surat_permohonan &&
                Storage::disk('public')->exists($emailRequest->surat_permohonan)
            ) {

                Storage::disk('public')->delete($emailRequest->surat_permohonan);
            }

            // Hapus data dari database
            $emailRequest->delete();
        });
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
