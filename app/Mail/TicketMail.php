<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    public function __construct(
        public Order $order,
        public Ticket $ticket
    ) {}

    public function build()
    {
        $qrUrl = route('ticket.verify', $this->ticket->qr_token);

        return $this->subject('Tiket Resmi - ' . $this->order->order_id)
            ->view('mail.ticket', [
                'order' => $this->order,
                'ticket' => $this->ticket,
                'qrUrl' => $qrUrl,
            ]);
    }
}

