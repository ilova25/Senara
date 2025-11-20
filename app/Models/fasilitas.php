<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitas extends Model
{
    use HasFactory;
    protected $fillable = ['nama','gambar'];
    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';

    public function unit()
    {
        return $this->belongsToMany(
            unit::class,
            'fasilitas_unit',
            'id_fasilitas',
            'id_unit'
        );
    }
}
