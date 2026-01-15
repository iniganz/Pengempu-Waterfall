<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class BrevoMailer
{
    /**
     * Send an email using Brevo's HTTPS API.
     * Brevo free tier: 300 emails/day, no domain verification required.
     *
     * @param string $from Email address, e.g. "Admin <no-reply@yourdomain.com>"
     * @param string $to Recipient email
     * @param string $subject Email subject
     * @param string $html HTML content
     * @return array Response from Brevo API
     */
    public static function send(string $from, string $to, string $subject, string $html): array
    {
        error_log('[BrevoMailer] send() called - to: ' . $to . ', subject: ' . $subject);

        Log::info('BrevoMailer::send() called', [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'html_length' => strlen($html),
        ]);

        $apiKey = (string) env('BREVO_API_KEY', '');
        if ($apiKey === '') {
            error_log('[BrevoMailer] ERROR: BREVO_API_KEY is not set!');
            Log::error('BREVO_API_KEY is not set or empty!');
            throw new \RuntimeException('BREVO_API_KEY is not set');
        }

        error_log('[BrevoMailer] API key exists: ' . substr($apiKey, 0, 10) . '...');

        // Parse "Name <email>" format
        $senderEmail = $from;
        $senderName = 'Pengempu Waterfall';

        if (preg_match('/^(.+?)\s*<(.+?)>$/', $from, $matches)) {
            $senderName = trim($matches[1]);
            $senderEmail = trim($matches[2]);
        }

        try {
            $response = Http::withHeaders([
                'accept' => 'application/json',
                'api-key' => $apiKey,
                'content-type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => [
                    'name' => $senderName,
                    'email' => $senderEmail,
                ],
                'to' => [
                    [
                        'email' => $to,
                    ]
                ],
                'subject' => $subject,
                'htmlContent' => $html,
            ]);

            $result = $response->json() ?? [];

            if ($response->successful()) {
                error_log('[BrevoMailer] SUCCESS! Message ID: ' . ($result['messageId'] ?? 'N/A'));
                Log::info('Brevo email sent successfully', [
                    'messageId' => $result['messageId'] ?? 'N/A',
                    'to' => $to,
                ]);
            } else {
                error_log('[BrevoMailer] FAILED! Status: ' . $response->status() . ', Body: ' . $response->body());
                Log::error('Brevo API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'to' => $to,
                ]);
                throw new \RuntimeException('Brevo API error: ' . $response->body());
            }

            return $result;

        } catch (\Exception $e) {
            error_log('[BrevoMailer] EXCEPTION: ' . $e->getMessage());
            Log::error('BrevoMailer exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
