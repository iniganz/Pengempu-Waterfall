<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * UNTUK PENGUNJUNG/PUBLIC - Hanya melihat status tiket tanpa mengubahnya
     */
    public function verify($token, Request $request)
    {
        $ticket = Ticket::where('qr_token', $token)->first();

        // Check ticket existence
        if (!$ticket) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'invalid', 'message' => 'Tiket tidak ditemukan']);
            }
            return view('publik.ticket.verify', [
                'status' => 'invalid',
                'message' => 'Tiket tidak ditemukan'
            ]);
        }

        // Check if payment is settled
        if ($ticket->order->payment_status !== 'settlement') {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'unpaid', 'message' => 'Pembayaran belum dikonfirmasi']);
            }
            return view('publik.ticket.verify', [
                'status' => 'unpaid',
                'message' => 'Pembayaran belum dikonfirmasi',
                'ticket' => $ticket
            ]);
        }

        // Increment scan count tanpa mengubah status
        $ticket->increment('scan_count');

        // Jika sudah di-validate oleh pengelola, tampilkan status used
        if ($ticket->isValidated()) {
            $validatedMessage = $ticket->validated_at ? $ticket->validated_at->format('d-m-Y H:i') : 'waktu tidak tersimpan';
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'used',
                    'message' => 'Tiket sudah digunakan',
                    'validated_at' => $validatedMessage,
                    'validated_by' => $ticket->validator?->name ?? 'Admin'
                ]);
            }
            return view('publik.ticket.verify', [
                'status' => 'used',
                'message' => 'Tiket sudah digunakan pada ' . $validatedMessage,
                'ticket' => $ticket
            ]);
        }

        // Tiket belum di-validate, tampilkan sebagai valid untuk dilihat pengunjung
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'valid',
                'message' => 'Tiket valid',
                'name' => $ticket->order->name,
                'ticket_code' => $ticket->ticket_code,
                'scan_count' => $ticket->scan_count
            ]);
        }

        return view('publik.ticket.verify', [
            'status' => 'valid',
            'message' => 'Tiket Valid - Data Anda Terverifikasi',
            'ticket' => $ticket,
            'isPublicView' => true
        ]);
    }

    /**
     * UNTUK PENGELOLA - Scan untuk validate tiket (ubah status jadi used)
     * Endpoint ini memerlukan authentication
     */
    public function validate($token, Request $request)
    {
        // Check authentication
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'unauthorized', 'message' => 'Anda harus login terlebih dahulu'], 401);
            }
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $ticket = Ticket::where('qr_token', $token)->first();

        // Check ticket existence
        if (!$ticket) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'invalid', 'message' => 'Tiket tidak ditemukan']);
            }
            return view('publik.ticket.validate', [
                'status' => 'invalid',
                'message' => 'Tiket tidak ditemukan'
            ]);
        }

        // Check if payment is settled
        if ($ticket->order->payment_status !== 'settlement') {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'unpaid', 'message' => 'Pembayaran belum dikonfirmasi']);
            }
            return view('publik.ticket.validate', [
                'status' => 'unpaid',
                'message' => 'Pembayaran belum dikonfirmasi',
                'ticket' => $ticket
            ]);
        }

        // Check if already validated
        if ($ticket->isValidated()) {
            $validatedMessage = $ticket->validated_at ? $ticket->validated_at->format('d-m-Y H:i') : 'waktu tidak tersimpan';
            $validatorName = $ticket->validator?->name ?? 'Admin';
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'used',
                    'message' => 'Tiket sudah divalidasi',
                    'validated_at' => $validatedMessage,
                    'validated_by' => $validatorName
                ]);
            }
            return view('publik.ticket.validate', [
                'status' => 'used',
                'message' => 'Tiket sudah divalidasi pada ' . $validatedMessage . ' oleh ' . $validatorName,
                'ticket' => $ticket
            ]);
        }

        // Validate ticket - mark as used dan catat siapa yang validate
        $ticket->update([
            'is_used' => true,
            'used_at' => now(),
            'validated_by' => Auth::id(),
            'validated_at' => now(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'valid',
                'message' => 'Tiket berhasil divalidasi',
                'name' => $ticket->order->name,
                'ticket_code' => $ticket->ticket_code,
                'validated_by' => Auth::user()->name,
                'validated_at' => $ticket->validated_at->format('d-m-Y H:i')
            ]);
        }

        return view('publik.ticket.validate', [
            'status' => 'valid',
            'message' => 'Tiket Berhasil Divalidasi',
            'ticket' => $ticket,
            'validator' => Auth::user()
        ]);
    }
}
