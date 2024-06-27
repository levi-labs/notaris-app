<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaPermohonan extends Model
{
    use HasFactory;

    protected $table = 'biaya_layanan';

    protected $fillable = [
        'nama_biaya',
        'harga',
        'layanan_permohonan_id'
    ];

    // public function harga(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) =>  'Rp.' . number_format($value, 0, ',', '.'),
    //         set: fn ($value) => str_replace('.', '', $value),
    //     );
    // }
    public function layanan()
    {
        return $this->belongsTo(LayananPermohonan::class, 'layanan_permohonan_id', 'id');
    }
}
