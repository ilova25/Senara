<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $fillable = ['nama_unit','gambar','deskripsi','harga'];
    protected $primaryKey = 'id_unit';

    public function siswa() {
        return $this->hasOne(booking::class, 'id_unit');
    }
}
