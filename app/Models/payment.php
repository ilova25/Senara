<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = [
        'booking_id',
        'order_id',
        'transaction_id',
        'metode_pembayaran',
        'status_pembayaran',
        'gross_amount',
        'snap_token'
    ];

    protected $primaryKey = 'id';

    public function booking() {
        return $this->belongsTo(booking::class);
    }
}
