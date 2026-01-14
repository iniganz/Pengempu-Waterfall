<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendContactEmail implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $timeout = 90;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $data
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to('pengempuw@gmail.com')->send(
                new SendMail($this->data)
            );
            Log::info('Contact email sent successfully from: ' . $this->data['email']);
        } catch (\Exception $e) {
            Log::error('Failed to send contact email: ' . $e->getMessage());
            throw $e;
        }
    }
}
