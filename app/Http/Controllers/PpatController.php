<?php

namespace App\Http\Controllers;

use App\Models\BerkasLayanan;
use App\Models\LayananPermohonan;
use App\Models\Ppat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PpatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar Pengajuan PPAT';

        $data        = Ppat::all();
        return view('pages.ppat.index', compact('title', 'data'));
    }

    public function selectLayanan()
    {
        $title      = 'Pilih Layanan';
        $data    = LayananPermohonan::where('jenis_permohonan_id', 1)->get();

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



        return view('pages.ppat.create', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        switch ($request->layanan_permohonan_id) {
            case '1':
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
            default:
                break;
        }
        DB::beginTransaction();
        try {

            $data           = new Ppat();
            $data->nama_pihak_pertama = $request->nama_pihak_pertama;
            $data->nama_pihak_kedua = $request->nama_pihak_kedua;
            $data->alamat_asset_termohon = $request->alamat_asset_termohon;
            $data->layanan_permohonan_id = $request->layanan_permohonan_id;
            $data->user_id = 1;
            $data->save();
            $berkas_layanan = new BerkasLayanan();

            $berkas_layanan->ppat_id = $data->id;
            $berkas_layanan->user_id = 1;


            // $files = [
            //     $request->file('ktp_kk_penjual_pembeli'),
            //     $request->file('npwp_penjual_pembeli'),
            //     $request->file('bukti_lunas_pbb'),
            //     $request->file('sertifikat_tanah'),
            //     $request->file('buku_nikah'),
            // ];
            $files = [
                'ktp_kk_penjual_pembeli' => $request->file('ktp_kk_penjual_pembeli'),
                'npwp_penjual_pembeli' => $request->file('npwp_penjual_pembeli'),
                'bukti_lunas_pbb' => $request->file('bukti_lunas_pbb'),
                'sertifikat_tanah' => $request->file('sertifikat_tanah'),
                'buku_nikah' => $request->file('buku_nikah'),
            ];

            $temp_files = [];
            // for ($i = 0; $i <  count($files); $i++) {
            //     if ($files[$i]) {

            //         $ext = $files[$i]->getClientOriginalExtension();
            //         $path = $files[$i]->store('public/' . 'joko/' . $i);
            //         $temp_files[] = $path;
            //     }
            // }

            foreach ($files as $key => $value) {
                if ($files[$key]) {
                    $ext = $files[$key]->getClientOriginalExtension();
                    $path = $files[$key]->store('public/' . 'joko/' . $key);
                    $temp_files[] = $path;
                }
            }


            $berkas_layanan->files = json_encode($temp_files);

            $berkas_layanan->save();

            DB::commit();



            return redirect()->route('ppat.index')->with('success', 'Pengajuan PPAT Berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ppat $ppat)
    {
        //
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
        //
    }
}
