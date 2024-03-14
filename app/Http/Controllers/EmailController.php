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
        $status = $request->input('status', 'sent');
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
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);
    
        EmailMarketing::create([
            'subject' => $request->subject,
            'content' => $request->content,
            'status' => 'draft',
        ]);
    

        EmailMarketing::create([
            'subject' => $request->subject,
            'content' => $request->content,
            'status' => 'draft',
        ]);

        return redirect()->back()->with('success', 'Email Marketing berhasil disimpan.');
    }
    public function update(Request $request, EmailMarketing $email)
    {
        // Metode untuk memperbarui data email marketing dalam database
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
            'status' => 'draft',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);

        $email->update([
            'subject' => $request->subject,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Email Marketing updated successfully.');
    }

    public function destroy(EmailMarketing $email)
    {
        
        $email->delete();

        return redirect()->back()->with('success', 'Email Marketing deleted successfully.');
    }
   

    public function sendEmail($id)
    {
        $emailMarketing = EmailMarketing::findOrFail($id);

        $customers = User::all();
        foreach ($customers as $subscriber) {
            SendEmailMarketingJob::dispatch($emailMarketing, $subscriber)->delay(now()->addSeconds(10));
        }

        $emailMarketing->update(['status' => 'sent']);

        return redirect()->back()->with('success', 'Email Marketing berhasil dikirim ');
    }
}
