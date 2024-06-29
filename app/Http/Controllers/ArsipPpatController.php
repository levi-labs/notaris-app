<?php

namespace App\Http\Controllers;

use App\Models\ArsipPpat;
use App\Models\Ppat;
use Illuminate\Http\Request;

class ArsipPpatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $title = 'Form Arsip Ppat';
        $ppat = Ppat::find($id);


        return view('pages.arsip-ppat.create', compact('title', 'ppat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'ppat_id' => 'required',
            'layanan_permohonan_id' => 'required',
            'no_akta' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);
        try {
            $data                           = new ArsipPpat();
            $data->ppat_id                  = $request->ppat_id;
            $data->layanan_permohonan_id    = $request->layanan_permohonan_id;
            $data->no_arsip                 = $data->getKodeArsipPpat();
            $data->no_akta                  = $request->no_akta;

            $file = $request->file('file');
            $fileName = $data->no_arsip . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('arsip-ppat', $fileName, 'public');
            $data->file = $filePath;
            $data->save();

            return redirect()->route('arsip-ppat.index')->with('success', 'Data arsip ppat berhasil ditambahkan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ArsipPpat $arsipPpat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArsipPpat $arsipPpat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArsipPpat $arsipPpat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArsipPpat $arsipPpat)
    {
        //
    }
}
