<?php

namespace App\Http\Controllers;

use App\Models\BiayaPermohonan;
use App\Models\LayananPermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BiayaPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Biaya Layanan';

        $layanan = LayananPermohonan::all();

        $data = DB::table('biaya_layanan')
            ->join('layanan_permohonan', 'biaya_layanan.layanan_permohonan_id', '=', 'layanan_permohonan.id')
            ->join('jenis_permohonan', 'layanan_permohonan.jenis_permohonan_id', '=', 'jenis_permohonan.id')
            ->select('biaya_layanan.layanan_permohonan_id', 'layanan_permohonan.nama', 'layanan_permohonan.id', 'jenis_permohonan.nama as nama_jenis')
            ->groupBy('layanan_permohonan.id', 'layanan_permohonan.nama', 'layanan_permohonan_id', 'nama_jenis')
            ->get();
        return view('pages.biaya-layanan.index', compact('title', 'data', 'layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'layanan_select' => 'required',
                'nama_biaya' => 'required',
                'biaya_layanan' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->toArray()], 422);
            } else {

                BiayaPermohonan::create([
                    'layanan_permohonan_id' => $request->get('layanan_select'),
                    'nama_biaya' => $request->get('nama_biaya'),
                    'harga' => $request->get('biaya_layanan'),
                ]);
                return response()->json(['success' => 'Data tersimpan'], 200);
            }


            // Perform the actual storage logic here

        } catch (\Exception $e) {
            // Handle the exception and display an error message
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {


        $data = BiayaPermohonan::where('layanan_permohonan_id', $id)->get();
        $getName = LayananPermohonan::where('id', $id)->first();
        $title = 'detail biaya layanan' . ' ' . strtolower($getName->nama);

        $layanan = LayananPermohonan::all();

        return view('pages.biaya-layanan.detail', compact('title', 'data', 'layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BiayaPermohonan $biayaPermohonan)
    {

        return response()->json(['data' => $biayaPermohonan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BiayaPermohonan $biayaPermohonan)
    {

        $validate = Validator::make($request->all(), [
            'layanan_select' => 'required',
            'nama_biaya' => 'required',
            'biaya_layanan' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()->toArray()], 422);
        }

        try {

            $biayaPermohonan->update([
                'layanan_permohonan_id' => $request->get('layanan_select'),
                'nama_biaya' => $request->get('nama_biaya'),
                'harga' => $request->get('biaya_layanan'),
            ]);

            return response()->json(['success' => 'Data terupdate'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BiayaPermohonan $biayaPermohonan)
    {
        $biayaPermohonan->delete();
        return redirect()->back()->with('success', 'Data terhapus');
    }
}
