<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBiayaPermohonan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_biaya_permohonan';

    protected $guarded = ['id'];
}
