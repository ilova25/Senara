<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $fillable = ['nama_unit','gambar','deskripsi','harga','available'];
    protected $primaryKey = 'id_unit';

    public function bookings() {
        return $this->hasMany(booking::class);
    }
}
