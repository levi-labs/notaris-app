<?php

namespace App\Http\Controllers;

use App\Models\JenisPermohonan;
use Illuminate\Http\Request;

class JenisPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Jenis Permohonan';

        $data = JenisPermohonan::all();

        return view('pages.jenis-permohonan.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Form Tambah Jenis Permohonan';

        return view('pages.jenis-permohonan.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        try {
            JenisPermohonan::create([
                'nama' => $request->get('nama'),
                'deskripsi' => $request->get('deskripsi'),
            ]);
            return redirect()->route('permohonan.index')->with('success', 'Jenis Permohonan Berhasil di Tambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisPermohonan $jenisPermohonan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPermohonan $jenisPermohonan)
    {
        $title = 'Form Edit Jenis Permohonan';

        return view('pages.jenis-permohonan.edit', compact('title', 'jenisPermohonan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisPermohonan $jenisPermohonan)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        try {
            $jenisPermohonan->update([
                'nama' => $request->get('nama'),
                'deskripsi' => $request->get('deskripsi'),
            ]);
            return redirect()->route('permohonan.index')->with('success', 'Jenis Permohonan Berhasil di Edit');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisPermohonan $jenisPermohonan)
    {
        try {
            $jenisPermohonan->delete();
            return redirect()->route('permohonan.index')->with('success', 'Jenis Permohonan Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
