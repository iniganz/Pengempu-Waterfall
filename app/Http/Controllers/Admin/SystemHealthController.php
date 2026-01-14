<?php

namespace App\Http\Controllers\Admin;

use App\Services\ResendMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class SystemHealthController
{
    public function email(Request $request)
    {
        $to = $request->query('to', config('mail.from.address'));

        try {
            $html = '<p><strong>Resend test</strong> - ' . e(now()->toDateTimeString()) . '</p>';

            ResendMailer::send(
                from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address')),
                to: (string) $to,
                subject: 'Resend test - Pengempu Waterfall',
                html: $html
            );

            Log::info('Health email sent via Resend', ['to' => $to]);

            return response()->json([
                'ok' => true,
                'to' => $to,
                'message' => 'Sent via Resend',
            ]);
        } catch (\Throwable $e) {
            Log::error('Health email failed', ['error' => $e->getMessage()]);

            return response()->json([
                'ok' => false,
                'to' => $to,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function storage()
    {
        $publicStoragePath = public_path('storage');

        return response()->json([
            'ok' => true,
            'public_storage_exists' => file_exists($publicStoragePath),
            'public_storage_is_link' => is_link($publicStoragePath),
            'public_storage_path' => $publicStoragePath,
            'disk_public_root' => config('filesystems.disks.public.root'),
            'disk_public_url' => config('filesystems.disks.public.url'),
        ]);
    }
}
