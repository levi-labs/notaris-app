<?php

namespace App\Models;

use Carbon\Carbon;
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


    public function getKodePengajuanPPAT()
    {

        $date = Carbon::now()->format('dm');
        $pengajuan = $this->count();

        if ($pengajuan == 0) {
            $counter  = 00001;
            $number   = 'NPAT-' . sprintf('%05s', $counter);
        } else {
            $last     = $this->all()->last();
            $sequence = (int)substr($last->nomor_pengajuan, -5) + 1;

            $number  = 'NPAT-' . sprintf('%05s', $sequence);
        }

        return $number;
    }
}
