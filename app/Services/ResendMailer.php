<?php

namespace App\Services;

use Resend;
use Illuminate\Support\Facades\Log;

class ResendMailer
{
    /**
     * Send an email using Resend's HTTPS API.
     *
     * @param string $from Email address, e.g. "Admin <no-reply@yourdomain>"
     * @param string $to
     * @param string $subject
     * @param string $html
     */
    public static function send(string $from, string $to, string $subject, string $html): array
    {
        // Force output to stderr for Railway logs
        error_log('[ResendMailer] send() called - to: ' . $to . ', subject: ' . $subject);

        Log::info('ResendMailer::send() called', [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
            'html_length' => strlen($html),
        ]);

        $apiKey = (string) env('RESEND_API_KEY', '');
        if ($apiKey === '') {
            error_log('[ResendMailer] ERROR: RESEND_API_KEY is not set!');
            Log::error('RESEND_API_KEY is not set or empty!');
            throw new \RuntimeException('RESEND_API_KEY is not set');
        }

        error_log('[ResendMailer] API key exists: ' . substr($apiKey, 0, 10) . '...');
        Log::debug('Resend API key exists', ['key_prefix' => substr($apiKey, 0, 10)]);

        try {
            $resend = Resend::client($apiKey);

            error_log('[ResendMailer] Client initialized, sending email...');
            Log::debug('Resend client initialized, sending email...');

            $response = $resend->emails->send([
                'from' => $from,
                'to' => [$to],
                'subject' => $subject,
                'html' => $html,
            ]);

            $result = (array) $response;

            error_log('[ResendMailer] SUCCESS! Resend ID: ' . ($result['id'] ?? 'N/A'));
            Log::info('Resend API response received', [
                'id' => $result['id'] ?? 'N/A',
                'response' => $result,
            ]);

            return $result;
        } catch (\Throwable $e) {
            error_log('[ResendMailer] ERROR: ' . $e->getMessage());
            Log::error('Resend API call failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
