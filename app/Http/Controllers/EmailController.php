<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailMarketingJob;
use App\Mail\SendEmail;
use App\Models\EmailMarketing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan status dari parameter request, default ke 'sent' jika tidak disediakan
        $status = $request->input('status', 'sent');

        // Mengambil data email berdasarkan status
        $emails = $this->getEmailsByStatus($status);

        return view('emails.index', [
            'emails' => $emails,
            'status' => $status,
        ]);
    }

    private function getEmailsByStatus($status)
    {
        return EmailMarketing::where('status', $status)->get();
        // Sesuaikan dengan struktur dan kondisi database Anda
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

        EmailMarketing::create([
            'subject' => $request->subject,
            'content' => $request->content,
            'status' => 'draft',
        ]);

        return redirect()->route('email.index')->with('success', 'Email Marketing berhasil disimpan.');
    }
    public function update(Request $request, EmailMarketing $email)
    {
        // Metode untuk memperbarui data email marketing dalam database
        $request->validate([
            'subject' => 'required|string',
            'content' => 'required|string',
        ]);

        $email->update([
            'subject' => $request->subject,
            'content' => $request->content,
        ]);

        return redirect()->route('email.index')->with('success', 'Email Marketing updated successfully.');
    }

    public function destroy(EmailMarketing $email)
    {
        // Metode untuk menghapus data email marketing dari database
        $email->delete();

        return redirect()->route('email.index')->with('success', 'Email Marketing deleted successfully.');
    }
   

    public function sendEmail($id)
    {
        $emailMarketing = EmailMarketing::findOrFail($id);

        // Ambil semua pelanggan
        $subscribers = User::all();

        foreach ($subscribers as $subscriber) {
            // Dispatch job untuk pengiriman email
            SendEmailMarketingJob::dispatch($emailMarketing, $subscriber)->delay(now()->addSeconds(10));
        }

        // Ubah status email marketing menjadi 'sent'
        $emailMarketing->update(['status' => 'sent']);

        return redirect()->route('email.index')->with('success', 'Email Marketing berhasil dikirim dengan menggunakan job dan queue.');
    }
}
