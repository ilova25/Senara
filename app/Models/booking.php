<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $fillable = ['id_user','nama','email','checkin','checkout','id_unit','total_harga','adult','children','kode_booking','status_menginap'];
    protected $primaryKey = 'id';

    public function unit() {
        return $this->belongsTo(unit::class, 'id_unit', 'id_unit');
    }

    public function user(){
        return $this->belongsTo(user::class, 'id_user','id');
    }

    public function payment()
    {
        return $this->hasOne(payment::class, 'booking_id', 'id');
    }

}
