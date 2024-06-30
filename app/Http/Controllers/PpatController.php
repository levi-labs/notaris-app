<?php

namespace App\Http\Controllers;

use App\Models\BerkasLayanan;
use App\Models\BiayaPermohonan;
use App\Models\BiayaTambahan;
use App\Models\BiayaTambahanPpat;
use App\Models\LayananPermohonan;
use App\Models\Ppat;
use App\Models\TransaksiBiayaPermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PpatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Pengajuan PPAT ';

        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Ppat::where('status_layanan', '1')->get();
            return view('pages.ppat.index', compact('title', 'data'));
        } else if (auth()->user()->type_user == 'client') {
            $data        = Ppat::where('user_id', auth()->user()->id)->where('status_layanan', '1')->get();
            return view('pages.ppat.index', compact('title', 'data'));
        }
    }
    public function index2()
    {

        $title      = 'Daftar Pengajuan PPAT (Terkonfirmasi) ';
        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Ppat::where('status_layanan', '2')->get();
            return view('pages.ppat.index2', compact('title', 'data'));
        } else {

            $data        = Ppat::where('user_id', auth()->user()->id)->where('status_layanan', '2')->get();


            return view('pages.ppat.index2', compact('title', 'data'));
        }
    }
    public function index3()
    {

        $title      = 'Daftar Pengajuan PPAT (Terverifikasi) ';
        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Ppat::where('status_layanan', '3')->get();
            return view('pages.ppat.index3', compact('title', 'data'));
        } else {

            $data        = Ppat::where('user_id', auth()->user()->id)->where('status_layanan', '3')->get();

            return view('pages.ppat.index3', compact('title', 'data'));
        }
    }

    public function index4()
    {

        $title      = 'Daftar Pengajuan PPAT (Selesai)';
        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Ppat::where('status_layanan', '4')->get();
            return view('pages.ppat.index4', compact('title', 'data'));
        } else {

            $data        = Ppat::where('user_id', auth()->user()->id)->where('status_layanan', '4')->get();
            return view('pages.ppat.index4', compact('title', 'data'));
        }
    }

    public function indexReject()
    {

        $title      = 'Daftar Pengajuan PPAT ditolak';

        if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master') {
            $data        = Ppat::where('status_layanan', '0')->get();
            return view('pages.ppat.indexReject', compact('title', 'data'));
        } else if (auth()->user()->type_user == 'client') {
            $data        = Ppat::where('user_id', auth()->user()->id)->where('status_layanan', '0')->get();
            return view('pages.ppat.indexReject', compact('title', 'data'));
        }
    }

    public function selectLayanan()
    {
        $title      = 'Pilih Layanan';
        $data       = LayananPermohonan::where('jenis_permohonan_id', 1)->get();

        return view('pages.ppat.layanan', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $title      = 'Form Pengajuan PPAT';
        $request->validate([
            'layanan_select' => 'required',
        ]);

        $requestLayanan    = $request->layanan_select;

        $data    = LayananPermohonan::where('id', $requestLayanan)->first();
        $nomor = new Ppat();





        return view('pages.ppat.create', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate request based on selected layanan_permohonan_id
        // $this->rulesFile($request);
        $request->validate([
            'layanan_permohonan_id' => 'required',
            'nama_pihak_pertama' => 'required',
            'nama_pihak_kedua' => 'required',
            'alamat_asset_termohon' => 'required',
            'file_ppat' => 'required|mimes:pdf|max:10000',
        ]);

        try {
            $file = $request->file('file_ppat');

            $namauser = auth()->user()->username;
            $path = $file->store('public/' . $namauser);


            $data           = new Ppat();
            $data->nama_pihak_pertama = $request->nama_pihak_pertama;
            $data->nama_pihak_kedua = $request->nama_pihak_kedua;
            $data->alamat_asset_termohon = $request->alamat_asset_termohon;
            $data->layanan_permohonan_id = $request->layanan_permohonan_id;
            $data->user_id = auth()->user()->id;
            $data->status_layanan = 1;
            $data->nomor_pengajuan = $data->getKodePengajuanPPAT();
            $data->file_ppat = $path;
            $data->save();

            // $temp_files = $this->handleUpload($request);
            // $berkas_layanan = new BerkasLayanan();

            // $berkas_layanan->ppat_id = $data->id;
            // $berkas_layanan->user_id = auth()->user()->id;

            // $berkas_layanan->files = json_encode($temp_files);

            // $berkas_layanan->save();

            // DB::commit();



            return redirect()->route('ppat.index')->with('success', 'Pengajuan PPAT Berhasil');
        } catch (\Throwable $th) {
            // DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function handleUpload(Request $request)
    {
        if ($request->layanan_permohonan_id == '1') {
            $files = [
                'ktp_kk_penjual_pembeli' => $request->file('ktp_kk_penjual_pembeli'),
                'npwp_penjual_pembeli' => $request->file('npwp_penjual_pembeli'),
                'bukti_lunas_pbb' => $request->file('bukti_lunas_pbb'),
                'sertifikat_tanah' => $request->file('sertifikat_tanah'),
                'buku_nikah' => $request->file('buku_nikah'),
            ];
        } elseif ($request->layanan_permohonan_id == '2') {
            $files = [
                'ktp_kk_pemberi_penerima_hibah' => $request->file('ktp_kk_pemberi_penerima_hibah'),
                'npwp_pemberi_penerima_hibah' => $request->file('npwp_pemberi_penerima_hibah'),
                'bukti_lunas_pbb' => $request->file('bukti_lunas_pbb'),
                'sertifikat_tanah' => $request->file('sertifikat_tanah'),
                'buku_nikah' => $request->file('buku_nikah'),
            ];
        } elseif ($request->layanan_permohonan_id == '3') {
            $files = [
                'ktp_kk_ahli_waris' => $request->file('ktp_kk_ahli_waris'),
                'npwp_ahli_waris' => $request->file('npwp_ahli_waris'),
                'bukti_lunas_pbb' => $request->file('bukti_lunas_pbb'),
                'surat_kematian_pewaris' => $request->file('surat_kematian_pewaris'),
                'akta_kelahiran_ahli_waris' => $request->file('akta_kelahiran_ahli_waris'),
                'pernyataan_ahli_waris' => $request->file('pernyataan_ahli_waris'),
                'sertifikat_tanah' => $request->file('sertifikat_tanah'),
                'buku_nikah' => $request->file('buku_nikah'),
            ];
        }
        $temp_files = [];
        $namauser = auth()->user()->username;
        foreach ($files as $key => $value) {
            if ($files[$key]) {
                $ext = $files[$key]->getClientOriginalExtension();
                $path = $files[$key]->store('public/' . $namauser . '/' . $key);
                $temp_files[] = $path;
            }
        }

        return $temp_files;
    }

    /**
     * Display the specified resource.
     */
    public function show(Ppat $ppat)
    {
        $subtitle = strtolower($ppat->layanan->nama);
        $title  = 'Detail Pengajuan ' . $subtitle;
        // $berkas = BerkasLayanan::where('ppat_id', $ppat->id)->first();
        // $lampiran = json_decode($berkas->files);
        $biayalayanan = BiayaPermohonan::where('layanan_permohonan_id', $ppat->layanan_permohonan_id)->get();
        $biayaTambahan = BiayaTambahanPpat::where('ppat_id', $ppat->id)->get();



        return view('pages.ppat.detail', compact(
            'title',
            'ppat',
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

    public function cetakPPAT(Ppat $ppat)
    {

        $title  = 'Cetak PPAT';
        // $berkas = BerkasLayanan::where('ppat_id', $ppat->id)->first();
        // $lampiran = json_decode($berkas->files);

        $biayalayanan = BiayaPermohonan::where('layanan_permohonan_id', $ppat->layanan_permohonan_id)->get();
        $biayaTambahan = BiayaTambahanPpat::where('ppat_id', $ppat->id)->get();


        return view('pages.ppat.cetak-ppat', compact(
            'title',
            'ppat',
            'biayalayanan',
            'biayaTambahan'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ppat $ppat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ppat $ppat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ppat $ppat)
    {
        try {
            $berkas = BerkasLayanan::where('ppat_id', $ppat->id)->first();
            $files = json_decode($berkas->files);
            $temp_delete = [];
            foreach ($files as $file) {
                if (Storage::exists($file)) {
                    Storage::delete($file);
                }
            }
            $ppat->delete();
            return redirect()->route('ppat.index')->with('success', 'Pengajuan PPAT Berhasil');
        } catch (\Exception $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function confirm(Ppat $ppat)
    {


        $ppat->status_layanan = 2;
        $ppat->save();
        return redirect()->route('ppat.index2')->with('success', 'Pengajuan PPAT di konfirmasi');
    }

    public function pembayaranLayanan(Ppat $ppat)
    {
        try {
            $transaksi = new TransaksiBiayaPermohonan();
            $exist = TransaksiBiayaPermohonan::where('ppat_id', $ppat->id)->first();

            if ($exist != null) {

                $exist->update([
                    'status' => 'Lunas'
                ]);
                return redirect()->back()->with('success', 'Pembayaran PPAT Berhasil');
            } else {

                $transaksi->ppat_id = $ppat->id;
                $transaksi->layanan_permohonan_id = $ppat->layanan_permohonan_id;
                $transaksi->status = 'Lunas';
                $transaksi->save();

                return redirect()->back()->with('success', 'Pembayaran PPAT Berhasil');
            }
        } catch (\Exception $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function pembayaranTambahan(Ppat $ppat)
    {
        try {
            $biayaTambahan = BiayaTambahanPpat::where('ppat_id', $ppat->id)->get();
            foreach ($biayaTambahan as $key => $value) {
                BiayaTambahanPpat::where('id', $value->id)->update([
                    'status' => 'lunas'
                ]);
            }

            return redirect()->back()->with('success', 'Pembayaran PPAT Biaya Tambahan Berhasil');
        } catch (\Exception $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function verifikasi(Ppat $ppat)
    {
        try {
            $transaksi = TransaksiBiayaPermohonan::where('ppat_id', $ppat->id)->exists();
            if ($transaksi) {
                $ppat->status_layanan = 3;
                $ppat->save();
                return redirect()->route('ppat.index3')->with('success', 'Pengajuan PPAT di verifikasi');
            }

            return redirect()->back()->with('error', 'Pembayaran PPAT Belum Lunas');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function finish(Ppat $ppat)
    {
        try {
            $biayaTambahan = BiayaTambahanPpat::where('ppat_id', $ppat->id)->first();
            if ($biayaTambahan->status == 'belum lunas') {
                return redirect()->back()->with('error', 'Pembayaran PPAT Belum Lunas (Biaya Tambahan Belum Lunas)');
            } else {
                $ppat->status_layanan = 4;
                $ppat->save();
                return redirect()->route('ppat.index4')->with('success', 'Pengajuan PPAT di selesaikan');
            }
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Validates the request based on the value of the 'layanan_permohonan_id' field.
     *
     * @param Request $request The HTTP request object.
     * @throws Illuminate\Validation\ValidationException If the validation fails.
     * @return void
     */
    protected function rulesFile(Request $request)
    {
        switch ($request->layanan_permohonan_id) {
            case '1':
                // Validate for layanan_permohonan_id 1
                $request->validate(
                    [
                        'nama_pihak_pertama' => 'required',
                        'nama_pihak_kedua' => 'required',
                        'alamat_asset_termohon' => 'required',
                        'ktp_kk_penjual_pembeli' => "required|mimes:pdf|max:10000",
                        'npwp_penjual_pembeli' => "mimes:pdf|max:10000",
                        'bukti_lunas_pbb' => "required|mimes:pdf|max:10000",
                        'sertifikat_tanah' => "required|mimes:pdf|max:10000",
                        'buku_nikah' => "mimes:pdf|max:10000",
                    ]
                );
                break;
            case '2':
                // Validate for layanan_permohonan_id 2
                $request->validate(
                    [
                        'nama_pihak_pertama' => 'required',
                        'nama_pihak_kedua' => 'required',
                        'alamat_asset_termohon' => 'required',
                        'ktp_kk_pemberi_penerima_hibah' => "required|mimes:pdf|max:10000",
                        'npwp_pemberi_penerima_hibah' => "mimes:pdf|max:10000",
                        'bukti_lunas_pbb' => "required|mimes:pdf|max:10000",
                        'sertifikat_tanah' => "required|mimes:pdf|max:10000",
                        'buku_nikah' => "mimes:pdf|max:10000",
                    ]
                );
                break;
            case '3':
                // Validate for layanan_permohonan_id 3
                $request->validate(
                    [
                        'nama_pihak_pertama' => 'required',
                        'nama_pihak_kedua' => 'required',
                        'alamat_asset_termohon' => 'required',
                        'ktp_kk_ahli_waris' => "required|mimes:pdf|max:10000",
                        'npwp_ahli_waris' => "mimes:pdf|max:10000",
                        'bukti_lunas_pbb' => "required|mimes:pdf|max:10000",
                        'surat_kematian_pewaris' => "required|mimes:pdf|max:10000",
                        'akta_kelahiran_ahli_waris' => "required|mimes:pdf|max:10000",
                        'pernyataan_ahli_waris' => "required|mimes:pdf|max:10000",
                        'sertifikat_tanah' => "required|mimes:pdf|max:10000",
                        'buku_nikah' => "mimes:pdf|max:10000",
                    ]
                );
                break;
            default:
                // Do nothing
        }
    }
}
