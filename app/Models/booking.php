<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $fillable = ['username','email','check_in','check_out','id_unit'];
    protected $primaryKey = 'id_booking';

    public function unit() {
        return $this->belongsTo(unit::class);
    }
}
