<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBiayaPermohonanNotaris extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'transaksi_biaya_permohonan_notaris';
}
