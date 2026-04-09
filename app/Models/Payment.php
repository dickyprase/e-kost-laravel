<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'booking_id',
        'user_id',
        'nominal_dibayar',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'validasi',
    ];
    
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}