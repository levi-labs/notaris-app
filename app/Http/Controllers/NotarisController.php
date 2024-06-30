<?php

namespace App\Http\Controllers;

use App\Models\BiayaPermohonan;
use App\Models\BiayaTambahan;
use App\Models\BiayaTambahanNotaris;
use App\Models\BiayaTambahanPpat;
use App\Models\LayananPermohonan;
use App\Models\Notaris;
use App\Models\r;
use App\Models\TransaksiBiayaPermohonanNotaris;
use Illuminate\Http\Request;

class NotarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Pengajuan Notaris (Menunggu Konfirmasi) ';

        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Notaris::where('status_layanan', '1')->get();
            return view('pages.notaris.index', compact('title', 'data'));
        } else if (auth()->user()->type_user == 'client') {
            $data        = Notaris::where('user_id', auth()->user()->id)->where('status_layanan', '1')->get();
            return view('pages.notaris.index', compact('title', 'data'));
        }
    }

    public function index2()
    {
        $title      = 'Daftar Pengajuan Notaris (Terkonfirmasi) ';

        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Notaris::where('status_layanan', '2')->get();
            return view('pages.notaris.index2', compact('title', 'data'));
        } else if (auth()->user()->type_user == 'client') {
            $data        = Notaris::where('user_id', auth()->user()->id)->where('status_layanan', '2')->get();
            return view('pages.notaris.index2', compact('title', 'data'));
        }
    }

    public function index3()
    {

        $title      = 'Daftar Pengajuan Notaris (Terverikasi) ';

        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Notaris::where('status_layanan', '3')->get();
            return view('pages.notaris.index3', compact('title', 'data'));
        } else if (auth()->user()->type_user == 'client') {
            $data        = Notaris::where('user_id', auth()->user()->id)->where('status_layanan', '3')->get();
            return view('pages.notaris.index3', compact('title', 'data'));
        }
    }

    public function index4()
    {

        $title      = 'Daftar Pengajuan Notaris (Terselesaikan) ';
        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Notaris::where('status_layanan', '4')->get();
            return view('pages.notaris.index4', compact('title', 'data'));
        } else if (auth()->user()->type_user == 'client') {
            $data        = Notaris::where('user_id', auth()->user()->id)->where('status_layanan', '4')->get();
            return view('pages.notaris.index4', compact('title', 'data'));
        }
    }


    public function selectLayanan()
    {
        $title      = 'Pilih Layanan';
        $data       = LayananPermohonan::where('jenis_permohonan_id', 2)->get();

        return view('pages.notaris.layanan', compact('title', 'data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $title      = 'Form Pengajuan Notaris';
        $request->validate([
            'layanan_select' => 'required',
        ]);

        $requestLayanan    = $request->layanan_select;

        $data    = LayananPermohonan::where('id', $requestLayanan)->first();
        $nomor = new Notaris();





        return view('pages.notaris.create', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'layanan_permohonan_id' => 'required',
            'nama_pihak_pertama' => 'required',
            'nama_pihak_kedua' => 'required',
            'alamat_asset_termohon' => 'required',
            'file_notaris' => 'required|mimes:pdf|max:10000',
        ]);

        try {


            $file = $request->file('file_notaris');
            $filename = $file->getClientOriginalName();
            $namauser = auth()->user()->username;
            $nomor  = new Notaris();
            $path = $file->store('public/' . $namauser);

            $notaris = Notaris::create([
                'nomor_pengajuan' => $nomor->getKodePengajuanNotaris(),
                'layanan_permohonan_id' => $request->layanan_permohonan_id,
                'user_id' => auth()->user()->id,
                'status_layanan' => 1,
                'file_notaris' => $path,
                'nama_pihak_pertama' => $request->nama_pihak_pertama,
                'nama_pihak_kedua' => $request->nama_pihak_kedua,
                'alamat_asset_termohon' => $request->alamat_asset_termohon,
            ]);
            return redirect()->route('notaris.index')->with('success', 'Pengajuan Berhasil');
        } catch (\Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notaris $notaris)
    {
        $subtitle = strtolower($notaris->layanan->nama);
        $title  = 'Detail Pengajuan ' . $subtitle;

        $biayalayanan = BiayaPermohonan::where('layanan_permohonan_id', $notaris->layanan_permohonan_id)->get();
        $biayaTambahan = BiayaTambahanNotaris::where('notaris_id', $notaris->id)->get();



        return view('pages.notaris.detail', compact(
            'title',
            'notaris',
            'biayalayanan',
            'biayaTambahan'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notaris $notaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notaris $notaris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notaris $notaris)
    {
        //
    }


    public function confirm(Notaris $notaris)
    {


        $notaris->status_layanan = 2;
        $notaris->save();
        return redirect()->route('notaris.index2')->with('success', 'Pengajuan Notaris di konfirmasi');
    }

    public function pembayaranLayanan(Notaris $notaris)
    {
        try {
            $transaksi = new TransaksiBiayaPermohonanNotaris();
            $exist = TransaksiBiayaPermohonanNotaris::where('notaris_id', $notaris->id)->first();

            if ($exist != null) {

                $exist->update([
                    'status' => 'Lunas'
                ]);
                return redirect()->back()->with('success', 'Pembayaran Notaris Berhasil');
            } else {

                $transaksi->notaris_id = $notaris->id;
                $transaksi->layanan_permohonan_id = $notaris->layanan_permohonan_id;
                $transaksi->status = 'Lunas';
                $transaksi->save();

                return redirect()->back()->with('success', 'Pembayaran Notaris Berhasil');
            }
        } catch (\Exception $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function pembayaranTambahan(Notaris $notaris)
    {
        try {
            $biayaTambahan = BiayaTambahanNotaris::where('notaris_id', $notaris->id)->get();
            foreach ($biayaTambahan as $key => $value) {
                BiayaTambahanNotaris::where('id', $value->id)->update([
                    'status' => 'lunas'
                ]);
            }

            return redirect()->back()->with('success', 'Pembayaran Notaris Biaya Tambahan Berhasil');
        } catch (\Exception $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function verifikasi(Notaris $notaris)
    {
        try {
            $transaksi = TransaksiBiayaPermohonanNotaris::where('notaris_id', $notaris->id)->exists();
            if ($transaksi) {
                $notaris->status_layanan = 3;
                $notaris->save();
                return redirect()->route('notaris.index3')->with('success', 'Pengajuan Notaris di verifikasi');
            }

            return redirect()->back()->with('error', 'Pembayaran Notaris Belum Lunas');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function finish(Notaris $notaris)
    {
        try {
            $biayaTambahan = BiayaTambahanNotaris::where('notaris_id', $notaris->id)->first();
            if ($biayaTambahan->status == 'belum lunas') {
                return redirect()->back()->with('error', 'Pembayaran Notaris Belum Lunas (Biaya Tambahan Belum Lunas)');
            } else {
                $notaris->status_layanan = 4;
                $notaris->save();
                return redirect()->route('notaris.index4')->with('success', 'Pengajuan Notaris di selesaikan');
            }
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function cetakNotaris(Notaris $notaris)
    {

        $title  = 'Cetak Pengajuan Notaris';


        $biayalayanan = BiayaPermohonan::where('layanan_permohonan_id', $notaris->layanan_permohonan_id)->get();
        $biayaTambahan = BiayaTambahanNotaris::where('notaris_id', $notaris->id)->get();

        return view('pages.notaris.cetak-ppat', compact(
            'title',
            'notaris',
            'biayalayanan',
            'biayaTambahan'
        ));
    }
    public function download(Request $request)
    {

        $filename = $request->filename;
        $filePath = storage_path('app/' . $filename);

        if (file_exists($filePath)) {

            $headers = [

                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
                'Content-Length' => strlen($filePath),
                'Content-Type' => 'application/pdf',
            ];
            $safeFilename = str_replace(['/', '\\'], '_', $filename);
            $saveFilename = explode('_', $safeFilename);
            $namedownloaded = array_shift($saveFilename);

            $downloadname = implode('_', $saveFilename);



            return response()->download($filePath, $downloadname, $headers);
        }
        return redirect()->back()->withErrors(['file' => 'File not found']);
    }
}
