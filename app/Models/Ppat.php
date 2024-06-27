<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppat extends Model
{
    use HasFactory;

    protected $table = 'ppat';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function layanan()
    {
        return $this->belongsTo(LayananPermohonan::class, 'layanan_permohonan_id', 'id');
    }
}
