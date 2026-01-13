<?php

namespace App\Helpers;

use App\Models\Ticket;
use Carbon\Carbon;

class TicketHelper
{
    /**
     * Get tickets yang belum divalidasi tapi sudah discan
     */
    public static function getScannedButNotValidated()
    {
        return Ticket::where('is_used', false)
            ->where('scan_count', '>', 0)
            ->with('order')
            ->orderByDesc('updated_at')
            ->get();
    }

    /**
     * Get tickets yang sudah divalidasi hari ini
     */
    public static function getTodayValidated()
    {
        return Ticket::whereDate('validated_at', today())
            ->with('validator:id,name', 'order:id,name,total')
            ->orderByDesc('validated_at')
            ->get();
    }

    /**
     * Get tickets yang sudah divalidasi dalam range tanggal
     */
    public static function getValidatedBetween(Carbon $start, Carbon $end)
    {
        return Ticket::whereBetween('validated_at', [$start, $end])
            ->with('validator:id,name', 'order:id,name,total,reserve_date')
            ->orderByDesc('validated_at')
            ->get();
    }

    /**
     * Get tickets yang divalidasi oleh user tertentu
     */
    public static function getValidatedByUser($userId)
    {
        return Ticket::where('validated_by', $userId)
            ->with('order', 'validator')
            ->orderByDesc('validated_at')
            ->get();
    }

    /**
     * Get statistic untuk dashboard
     */
    public static function getDashboardStats($date = null)
    {
        $date = $date ?? today();

        return [
            'total_validated_today' => Ticket::whereDate('validated_at', $date)->count(),
            'total_scanned' => Ticket::whereDate('updated_at', $date)->sum('scan_count'),
            'pending_validation' => Ticket::where('is_used', false)
                ->where('scan_count', '>', 0)
                ->whereDate('updated_at', $date)
                ->count(),
            'revenue_today' => Ticket::whereDate('validated_at', $date)
                ->with('order')
                ->get()
                ->sum(fn($t) => $t->order->total ?? 0),
        ];
    }

    /**
     * Check apakah tiket sudah terpakai
     */
    public static function isTicketUsed($ticketCode)
    {
        return Ticket::where('ticket_code', $ticketCode)
            ->first()
            ?->isValidated() ?? false;
    }

    /**
     * Get ticket info lengkap
     */
    public static function getTicketInfo($qrToken)
    {
        return Ticket::where('qr_token', $qrToken)
            ->with(['order' => function($q) {
                $q->select('id', 'order_id', 'name', 'product_id', 'qty', 'total', 'payment_status', 'reserve_date');
            }, 'order.product' => function($q) {
                $q->select('id', 'title', 'slug');
            }, 'validator' => function($q) {
                $q->select('id', 'name', 'email');
            }])
            ->first();
    }

    /**
     * Generate QR verify link
     */
    public static function generateVerifyLink($qrToken)
    {
        return route('ticket.verify', $qrToken);
    }

    /**
     * Generate QR validate link (untuk pengelola)
     */
    public static function generateValidateLink($qrToken)
    {
        return route('ticket.validate', $qrToken);
    }

    /**
     * Check berapa lama tiket sudah tervalidasi
     */
    public static function getValidationDuration($ticket)
    {
        if (!$ticket->isValidated()) {
            return null;
        }

        return now()->diffInSeconds($ticket->validated_at);
    }

    /**
     * Check apakah scan dilakukan dengan pattern mencurigakan (scan berkali-kali cepat)
     */
    public static function isSuspiciousBehavior($ticketId)
    {
        $ticket = Ticket::find($ticketId);

        if (!$ticket || $ticket->scan_count <= 2) {
            return false;
        }

        // Suspicious jika lebih dari 5x scan dalam 10 menit
        return $ticket->scan_count > 5
            && $ticket->updated_at->diffInMinutes(now()) < 10;
    }

    /**
     * Get leaderboard - pengelola dengan validasi terbanyak hari ini
     */
    public static function getValidationLeaderboard($date = null)
    {
        $date = $date ?? today();

        return Ticket::whereDate('validated_at', $date)
            ->selectRaw('validated_by, COUNT(*) as total_validated')
            ->groupBy('validated_by')
            ->orderByDesc('total_validated')
            ->with('validator:id,name')
            ->get();
    }
}
