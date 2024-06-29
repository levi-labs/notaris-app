<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipPpat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'arsip_ppat';

    public function getKodeArsipPpat()
    {

        $date = Carbon::now()->format('dmy');
        $pengajuan = $this->count();
        $counter  = rand(0, 99999);

        $number   = 'APPAT/' . $date . '/' . $counter;




        return $number;
    }
}
