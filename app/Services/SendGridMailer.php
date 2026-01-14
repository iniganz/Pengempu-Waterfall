<?php

namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\Log;

class SendGridMailer
{
    /**
     * Send an email using SendGrid's HTTP API.
     *
     * @param string $from Email address, e.g. "Admin <no-reply@yourdomain>"
     * @param string $to
     * @param string $subject
     * @param string $html
     */
    public static function send(string $from, string $to, string $subject, string $html): array
    {
        error_log('[SendGridMailer] send() called - to: ' . $to . ', subject: ' . $subject);

        Log::info('SendGridMailer::send() called', [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'html_length' => strlen($html),
        ]);

        $apiKey = (string) env('SENDGRID_API_KEY', '');
        if ($apiKey === '') {
            error_log('[SendGridMailer] ERROR: SENDGRID_API_KEY is not set!');
            Log::error('SENDGRID_API_KEY is not set or empty!');
            throw new \RuntimeException('SENDGRID_API_KEY is not set');
        }

        error_log('[SendGridMailer] API key exists: ' . substr($apiKey, 0, 10) . '...');
        Log::debug('SendGrid API key exists', ['key_prefix' => substr($apiKey, 0, 10)]);

        [$fromEmail, $fromName] = self::parseFromAddress($from);

        try {
            $email = new Mail();
            $email->setFrom($fromEmail, $fromName ?: null);
            $email->setSubject($subject);
            $email->addTo($to);
            $email->addContent('text/html', $html);

            $sendgrid = new SendGrid($apiKey);

            error_log('[SendGridMailer] Client initialized, sending email...');
            Log::debug('SendGrid client initialized, sending email...');

            $response = $sendgrid->send($email);

            $result = [
                'statusCode' => $response->statusCode(),
                'headers' => $response->headers(),
                'body' => $response->body(),
            ];

            error_log('[SendGridMailer] SUCCESS! Status: ' . $result['statusCode']);
            Log::info('SendGrid API response received', $result);

            return $result;
        } catch (\Throwable $e) {
            error_log('[SendGridMailer] ERROR: ' . $e->getMessage());
            Log::error('SendGrid API call failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    private static function parseFromAddress(string $from): array
    {
        if (preg_match('/^\s*(.+?)\s*<([^>]+)>\s*$/', $from, $matches)) {
            $name = trim($matches[1], " \t\n\r\0\x0B\"");
            $email = trim($matches[2]);
            return [$email, $name];
        }

        return [trim($from), null];
    }
}
