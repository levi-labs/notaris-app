<?php

namespace App\Http\Controllers;

use App\Models\Notaris;
use App\Models\Ppat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        if (auth()->user()->type_user == 'client') {
            $daftar_ppat = Ppat::where('user_id', auth()->user()->id)->latest()->take(10)->get();
            $daftar_notaris = Notaris::where('user_id', auth()->user()->id)->latest()->take(10)->get();
            $total_ppat = DB::table('ppat')->where('user_id', auth()->user()->id)->count();
            $total_notaris = DB::table('notaris')->where('user_id', auth()->user()->id)->count();
            $data = DB::table('ppat')->where('user_id', auth()->user()->id)->count();
            $data_1 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '1')->count();
            $data_2 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '2')->count();
            $data_3 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '3')->count();
            $data_4 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '4')->count();
            $data_5 = DB::table('notaris')->where('user_id', auth()->user()->id)->where('status_layanan', '1')->count();
            $data_6 = DB::table('notaris')->where('user_id', auth()->user()->id)->where('status_layanan', '2')->count();
            $data_7 = DB::table('notaris')->where('user_id', auth()->user()->id)->where('status_layanan', '3')->count();
            $data_8 = DB::table('notaris')->where('user_id', auth()->user()->id)->where('status_layanan', '4')->count();

            // $data_5 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '5')->count();
            // $data_6 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '6')->count();

            return view('pages.dashboard.index', compact(
                'title',
                'daftar_ppat',
                'daftar_notaris',
                'data',
                'data_1',
                'data_2',
                'data_3',
                'data_4',
                'data_5',
                'data_6',
                'data_7',
                'data_8',
                'total_ppat',
                'total_notaris'
            ));
        } elseif (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $daftar_ppat = Ppat::latest()->take(10)->get();
            $daftar_notaris = Notaris::latest()->take(10)->get();
            $total_ppat = DB::table('ppat')->count();
            $total_notaris = DB::table('notaris')->count();
            $data_1 = DB::table('ppat')->where('status_layanan', '1')->count();
            $data_2 = DB::table('ppat')->where('status_layanan', '2')->count();
            $data_3 = DB::table('ppat')->where('status_layanan', '3')->count();
            $data_4 = DB::table('ppat')->where('status_layanan', '4')->count();
            $data_5 = DB::table('notaris')->where('status_layanan', '1')->count();
            $data_6 = DB::table('notaris')->where('status_layanan', '2')->count();
            $data_7 = DB::table('notaris')->where('status_layanan', '3')->count();
            $data_8 = DB::table('notaris')->where('status_layanan', '4')->count();
            // $data_5 = DB::table('ppat')->where('status_layanan', '5')->count();
            // $data_6 = DB::table('ppat')->where('status_layanan', '6')->count();
            return view('pages.dashboard.index', compact(
                'title',
                'daftar_ppat',
                'daftar_notaris',
                'total_ppat',
                'total_notaris',
                'data_1',
                'data_2',
                'data_3',
                'data_4',
                'data_5',
                'data_6',
                'data_7',
                'data_8'
            ));
        }
    }
}
