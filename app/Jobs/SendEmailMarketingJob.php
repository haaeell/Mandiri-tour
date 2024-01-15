<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use App\Models\EmailMarketing;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailMarketingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailMarketing;
    protected $subscriber;

    public function __construct(EmailMarketing $emailMarketing, User $subscriber)
    {
        $this->emailMarketing = $emailMarketing;
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     */
    
     public function handle()
     {
         // Kirim email ke pelanggan
         Mail::to($this->subscriber->email)->send(new SendEmail($this->emailMarketing, $this->subscriber));
     }
}
