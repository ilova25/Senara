<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masukan extends Model
{
    use HasFactory;
    protected $table = 'masukan';
    protected $fillable = ['masukan', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
