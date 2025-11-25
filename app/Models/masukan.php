<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masukan extends Model
{
    use HasFactory;
    protected $table = 'masukan';
    protected $fillable = ['booking_id','coment', 'rating', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(booking::class);
    }
}
