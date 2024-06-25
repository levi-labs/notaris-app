<?php

namespace App\Http\Controllers;

use App\Models\JenisPermohonan;
use App\Models\LayananPermohonan;
use Illuminate\Http\Request;

class LayananPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Layanan Permohonan';
        $data  = LayananPermohonan::all();

        return view('pages.layanan-permohonan.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Layanan Permohonan';

        $jenis_permohonan = JenisPermohonan::all();

        return view('pages.layanan-permohonan.create', compact('title', 'jenis_permohonan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_permohonan_id' => 'required',
            'deskripsi' => 'required',
            'syarat_ketentuan' => 'required',
        ]);
        try {

            LayananPermohonan::create($request->all());
            return redirect()->route('layanan.index')->with('success', 'Layanan Permohonan created successfully.');
        } catch (\Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LayananPermohonan $layananPermohonan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LayananPermohonan $layananPermohonan)
    {
        $title = 'Layanan Permohonan';

        $jenis_permohonan = JenisPermohonan::all();

        return view('pages.layanan-permohonan.edit', compact('title', 'jenis_permohonan', 'layananPermohonan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LayananPermohonan $layananPermohonan)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_permohonan_id' => 'required',
            'deskripsi' => 'required',
            'syarat_ketentuan' => 'required',
        ]);

        try {
            $layananPermohonan->update($request->all());
            return redirect()->route('layanan.index')->with('success', 'Layanan Permohonan updated successfully.');
        } catch (\Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LayananPermohonan $layananPermohonan)
    {
        try {
            $layananPermohonan->delete();

            return redirect()->route('layanan-permohonan.index')->with('success', 'Layanan Permohonan deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('layanan-permohonan.index')->with('error', 'Layanan Permohonan can not be deleted.');
        }
    }
}
