<?php

namespace App\Http\Controllers;

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
            $data = DB::table('ppat')->where('user_id', auth()->user()->id)->count();
            $data_1 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '1')->count();
            $data_2 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '2')->count();
            $data_3 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '3')->count();
            $data_4 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '4')->count();
            // $data_5 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '5')->count();
            // $data_6 = DB::table('ppat')->where('user_id', auth()->user()->id)->where('status_layanan', '6')->count();

            return view('pages.dashboard.index', compact('title', 'daftar_ppat', 'data', 'data_1', 'data_2', 'data_3', 'data_4'));
        }
        return view('pages.dashboard.index');
    }
}
