<?php

namespace App\Http\Controllers;

use App\Models\ArsipPpat;
use App\Models\Ppat;
use Illuminate\Http\Request;

class ReportPpatController extends Controller
{
    public function index()
    {
        $title = 'Report PPAT';
        return view('pages.report-ppat.index', compact('title'));
    }

    public function print(Request $request)
    {
        $title = 'Report PPAT';
        $from = $request->dari_tanggal;
        $to = $request->sampai_tanggal;

        $report = new ArsipPpat();
        $data = $report->getReport($from, $to);


        return view('pages.report-ppat.cetak', compact('title', 'data', 'from', 'to'));
    }
}
