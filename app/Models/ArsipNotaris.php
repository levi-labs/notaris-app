<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipNotaris extends Model
{
    use HasFactory;


    protected $table = 'arsip_notaris';
    protected $guarded = ['id'];
    public function getKodeArsipNotaris()
    {

        $date = Carbon::now()->format('dmy');
        $pengajuan = $this->count();
        $counter  = rand(0, 99999);

        $number   = 'ANTRS/' . $date . '/' . $counter;


        return $number;
    }

    public function layanan()
    {

        return $this->belongsTo(LayananPermohonan::class, 'layanan_permohonan_id', 'id');
    }
}
