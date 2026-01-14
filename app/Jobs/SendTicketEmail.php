<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Ticket;
use App\Mail\TicketMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendTicketEmail implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $timeout = 90;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Order $order,
        public Ticket $ticket
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->order->email)->send(
                new TicketMail($this->order, $this->ticket)
            );
            Log::info('Ticket email sent successfully to: ' . $this->order->email);
        } catch (\Exception $e) {
            Log::error('Failed to send ticket email: ' . $e->getMessage());
            throw $e; // Rethrow untuk retry
        }
    }
}
