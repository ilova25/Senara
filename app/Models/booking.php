<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $fillable = ['nama','email','checkin','checkout','id_unit','total_harga','adult','children'];
    protected $primaryKey = 'id';

    public function unit() {
        return $this->belongsTo(unit::class, 'id_unit', 'id_unit');
    }
}
