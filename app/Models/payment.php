<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = ['bukti_pembayaran','status_pembayaran','batas_pembayaran','booking_id'];
    protected $primaryKey = 'id';

    public function booking() {
        return $this->belongsTo(booking::class);
    }
}
