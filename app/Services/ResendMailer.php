<?php

namespace App\Services;

use Resend;

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
    public static function send(string $from, string $to, string $subject, string $html): void
    {
        $apiKey = (string) env('RESEND_API_KEY', '');
        if ($apiKey === '') {
            throw new \RuntimeException('RESEND_API_KEY is not set');
        }

        $resend = Resend::client($apiKey);

        $resend->emails->send([
            'from' => $from,
            'to' => [$to],
            'subject' => $subject,
            'html' => $html,
        ]);
    }
}
