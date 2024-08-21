<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getReport($from, $to)
    {
        if ($from !== null && $to === null) {
            $data = DB::table('arsip_notaris')
                ->join('notaris', 'arsip_notaris.notaris_id', '=', 'notaris.id')
                ->join('users', 'notaris.user_id', '=', 'users.id')
                ->join('layanan_permohonan', 'notaris.layanan_permohonan_id', '=', 'layanan_permohonan.id')
                ->join('jenis_permohonan', 'layanan_permohonan.jenis_permohonan_id', '=', 'jenis_permohonan.id')
                ->select('arsip_notaris.*', 'layanan_permohonan.nama as nama_layanan', 'jenis_permohonan.nama as nama_jenis', 'users.nama as nama')
                ->where('arsip_notaris.created_at', '>=', $from)
                ->get();
            return $data;
        } elseif ($from === null && $to !== null) {

            $data = DB::table('arsip_notaris')
                ->join('notaris', 'arsip_notaris.notaris_id', '=', 'notaris.id')
                ->join('users', 'notaris.user_id', '=', 'users.id')
                ->join('layanan_permohonan', 'notaris.layanan_permohonan_id', '=', 'layanan_permohonan.id')
                ->join('jenis_permohonan', 'layanan_permohonan.jenis_permohonan_id', '=', 'jenis_permohonan.id')
                ->select('arsip_notaris.*', 'layanan_permohonan.nama as nama_layanan', 'jenis_permohonan.nama as nama_jenis', 'users.nama as nama')
                ->where('arsip_notaris.created_at', '<=', $to)
                ->get();
            return $data;
        } elseif ($from !== null && $to !== null) {
            $data = DB::table('arsip_notaris')
                ->join('notaris', 'arsip_notaris.notaris_id', '=', 'notaris.id')
                ->join('users', 'notaris.user_id', '=', 'users.id')
                ->join('layanan_permohonan', 'notaris.layanan_permohonan_id', '=', 'layanan_permohonan.id')
                ->join('jenis_permohonan', 'layanan_permohonan.jenis_permohonan_id', '=', 'jenis_permohonan.id')
                ->select('arsip_notaris.*', 'layanan_permohonan.nama as nama_layanan', 'jenis_permohonan.nama as nama_jenis', 'users.nama as nama')
                ->where('arsip_notaris.created_at', '>=', $from)
                ->where('arsip_notaris.created_at', '<=', $to)
                ->get();
            return $data;
        }
    }
}
