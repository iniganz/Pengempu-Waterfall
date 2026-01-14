<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Jobs\SendContactEmail;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Services\ResendMailer;

class KontakController extends Controller
{

    public function contact()
    {
        return view('publik.page.contact', [
            'title' => 'Contact',
        ]);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $adminEmail = (string) config('mail.from.address', 'pengempuw@gmail.com');

            // Railway often can't reach Gmail SMTP reliably; prefer Resend API when configured.
            if (env('MAIL_MAILER') === 'resend' || env('RESEND_API_KEY')) {
                $html = View::make('emails.contact', ['data' => $data])->render();
                ResendMailer::send(
                    from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), $adminEmail),
                    to: 'pengempuw@gmail.com',
                    subject: !empty($data['subject']) ? (string) $data['subject'] : 'Pesan dari Contact Form',
                    html: $html
                );

                Log::info('Contact email sent via Resend from: ' . $data['email']);
            } else {
                // Fallback to Laravel Mail (SMTP/log depending on MAIL_MAILER)
                Mail::to('pengempuw@gmail.com')->send(new SendMail($data));
                Log::info('Contact email dispatched via Laravel mailer from: ' . $data['email']);
            }

            return back()->with('success', 'Pesan Anda telah dikirim. Terima kasih!');
        } catch (\Throwable $e) {
            Log::error('Contact mail error', ['error' => $e->getMessage(), 'from' => $data['email'] ?? null]);
            return back()->with('error', 'Maaf, pesan gagal dikirim.');
        }
    }
}
