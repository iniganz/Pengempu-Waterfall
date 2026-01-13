<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'order_id','ticket_code','qr_token','is_used','used_at',
        'validated_by','validated_at','scan_count'
    ];

    protected $casts = [
        'used_at' => 'datetime',
        'validated_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    // Check apakah sudah di-validate oleh pengelola
    public function isValidated()
    {
        return $this->is_used && !is_null($this->validated_by);
    }

    // Check apakah hanya di-scan (belum di-validate)
    public function isScannedOnly()
    {
        return !$this->is_used && $this->scan_count > 0;
    }
}

