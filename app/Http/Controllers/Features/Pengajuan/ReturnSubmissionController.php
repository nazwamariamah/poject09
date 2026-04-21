<?php

namespace App\Http\Controllers\Features\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\BudgetSubmission;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReturnSubmissionController extends Controller
{
    public function fixing(Request $request, $id)
    {
        $pengajuan = BudgetSubmission::with('user')->with('finance_officer')->findOrFail($id);
        $request->validate([
            'file_pengajuan' => 'mimes:pdf|max:51200|nullable',
        ]);

        if ($request->file_pengajuan) {
            if ($pengajuan->path_file_submission && Storage::disk('private')->exists($pengajuan->path_file_submission)) {
                Storage::disk('private')->delete($pengajuan->path_file_submission);

                $file = $request->file('file_pengajuan');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('pengajuan', $filename, 'private');
            }
        } else {
            $path = $pengajuan->path_file_submission;
        }

        // $fileName = 'CHECKLIST.xlsx';
        // $sourcePath = 'template/' . $fileName;
        // // ubah spasi menjadi underscore
        // $namaPengajuan = str_replace(' ', '_', $request->nama_pengajuan);
        // $newFileName = $namaPengajuan . '_' . $fileName;
        // $destinationPath = 'metadata_pengajuan/' . $newFileName;

        // if ($pengajuan->path_file_status_kelengkapan && Storage::disk('public')->exists($pengajuan->path_file_status_kelengkapan)) {
        //     Storage::disk('public')->move($pengajuan->path_file_status_kelengkapan, $destinationPath);
        // }

        // $sendername = User::where('id', $pengajuan->user_id)->where('name', $pengajuan->user->name)->first();
        // $senderemail = User::where('id', $pengajuan->user_id)->where('email', $pengajuan->user->email)->first();
        // $senderdivisi = User::where('id', $pengajuan->user_id)->where('role', $pengajuan->user->role)->first();

        // $receivername = User::where('id', $pengajuan->finance_officers_id)->where('name', $pengajuan->finance_officer->name)->first();
        // $receiveremail = User::where('id', $pengajuan->finance_officers_id)->where('role', $pengajuan->finance_officer->email)->first();
        // $receiver = User::where('id', $pengajuan->finance_officers_id)->first();

        // FacadesNotification::send($receiver, new BudgetSubmitToRepairedNotification($sendername, $senderemail, $senderdivisi, $receivername, $receiveremail));

        $pengajuan->update([
            'path_file_submission' => $path,
            'assigned_payment_method' => $request->payment_method,
            'assigned_funding_source' => $request->funding_source,
            'is_marked' => 0,
            'is_return' => 0,
            // 'path_file_status_kelengkapan' => $destinationPath,
        ]);

        // tambahan code
        $keuanganUsers = User::where('role', 'Keuangan')->get();

        foreach ($keuanganUsers as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Pengajuan Diperbarui',
                'message' => 'Pengajuan yang sebelumnya gagal telah diperbarui oleh pengaju.',
                'type' => 'warning',
                'url' => route('verification.show', $pengajuan->id),
            ]);
        }

        return redirect()->route('user.monitoring')->with('success', 'Berhasil Mengirim Pengajuan');
    }
}
