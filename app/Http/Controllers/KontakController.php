<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Jobs\SendContactEmail;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
            // Send email after HTTP response (non-blocking)
            register_shutdown_function(function() use ($data) {
                try {
                    Mail::to('pengempuw@gmail.com')->send(
                        new SendMail($data)
                    );
                    Log::info('Contact email sent successfully from: ' . $data['email']);
                } catch (\Exception $e) {
                    Log::error('Failed to send contact email: ' . $e->getMessage());
                }
            });

            Log::info('Contact email scheduled from: ' . $data['email']);

            return back()->with('success', 'Pesan Anda telah dikirim. Terima kasih!');
        } catch (\Exception $e) {
            Log::error('Contact mail error: ' . $e->getMessage());
            return back()->with('error', 'Maaf, pesan gagal dikirim.');
        }
    }
}
