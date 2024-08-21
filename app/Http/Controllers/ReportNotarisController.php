<?php

namespace App\Http\Controllers;

use App\Models\ArsipNotaris;
use Illuminate\Http\Request;

class ReportNotarisController extends Controller
{
    public function index()
    {
        $title = 'Report Notaris';
        return view('pages.report-notaris.index', compact('title'));
    }

    public function print(Request $request)
    {
        $title = 'Report Notaris';
        $from = $request->dari_tanggal;
        $to = $request->sampai_tanggal;

        $report = new ArsipNotaris();
        $data = $report->getReport($from, $to);

        return view('pages.report-notaris.cetak', compact('title', 'data', 'from', 'to'));
    }
}
