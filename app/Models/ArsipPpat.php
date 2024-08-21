<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function layanan()
    {

        return $this->belongsTo(LayananPermohonan::class, 'layanan_permohonan_id', 'id');
    }

    public function getReport($from, $to)
    {

        if ($from !== null && $to === null) {
            $data = DB::table('arsip_ppat')
                ->join('ppat', 'arsip_ppat.ppat_id', '=', 'ppat.id')
                ->join('users', 'ppat.user_id', '=', 'users.id')
                ->join('layanan_permohonan', 'ppat.layanan_permohonan_id', '=', 'layanan_permohonan.id')
                ->join('jenis_permohonan', 'layanan_permohonan.jenis_permohonan_id', '=', 'jenis_permohonan.id')
                ->select('arsip_ppat.*', 'layanan_permohonan.nama as nama_layanan', 'jenis_permohonan.nama as nama_jenis', 'users.nama as nama')
                ->where('arsip_ppat.created_at', '>=', $from)
                ->get();
            return $data;
        } elseif ($from === null && $to !== null) {

            $data = DB::table('arsip_ppat')
                ->join('ppat', 'arsip_ppat.ppat_id', '=', 'ppat.id')
                ->join('users', 'ppat.user_id', '=', 'users.id')
                ->join('layanan_permohonan', 'ppat.layanan_permohonan_id', '=', 'layanan_permohonan.id')
                ->join('jenis_permohonan', 'layanan_permohonan.jenis_permohonan_id', '=', 'jenis_permohonan.id')
                ->select('arsip_ppat.*', 'layanan_permohonan.nama as nama_layanan', 'jenis_permohonan.nama as nama_jenis', 'users.nama as nama')
                ->where('arsip_ppat.created_at', '<=', $to)
                ->get();
            return $data;
        } elseif ($from !== null && $to !== null) {

            $data = DB::table('arsip_ppat')
                ->join('ppat', 'arsip_ppat.ppat_id', '=', 'ppat.id')
                ->join('users', 'ppat.user_id', '=', 'users.id')
                ->join('layanan_permohonan', 'ppat.layanan_permohonan_id', '=', 'layanan_permohonan.id')
                ->join('jenis_permohonan', 'layanan_permohonan.jenis_permohonan_id', '=', 'jenis_permohonan.id')
                ->select('arsip_ppat.*', 'layanan_permohonan.nama as nama_layanan', 'jenis_permohonan.nama as nama_jenis', 'users.nama as nama')
                ->whereBetween('arsip_ppat.created_at', [$from, $to])
                ->get();
            return $data;
        }
    }
}
