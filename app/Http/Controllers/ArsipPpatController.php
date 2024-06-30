<?php

namespace App\Http\Controllers;

use App\Models\ArsipPpat;
use App\Models\Ppat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\select;

class ArsipPpatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Arsip Ppat';
        $data = ArsipPpat::all();
        return view('pages.arsip-ppat.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = null)
    {
        $title = 'Form Arsip Ppat';
        if ($id) {
            $ppat = Ppat::find($id);
            $ppat_id = $ppat->id;
            $layanan_permohonan_id = $ppat->layanan_permohonan_id;
            return view('pages.arsip-ppat.create', compact('title', 'ppat', 'ppat_id', 'layanan_permohonan_id'));
        } else {
            $ppat = DB::table('ppat')
                ->select('ppat.*')
                ->leftJoin('arsip_ppat', 'ppat.id', '=', 'arsip_ppat.ppat_id')
                ->whereNull('arsip_ppat.ppat_id')
                ->get();

            // dd(is_object($ppat));
            return view('pages.arsip-ppat.create', compact('title', 'ppat'));
        }



        // return view('pages.arsip-ppat.create', compact('title', 'ppat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'ppat_id' => 'required',
            'no_akta' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        try {
            $layanan_id = Ppat::where('id', $request->ppat_id)->first();

            $data                           = new ArsipPpat();
            $data->ppat_id                  = $request->ppat_id;
            $data->layanan_permohonan_id    = $request->layanan_permohonan_id ?? $layanan_id->layanan_permohonan_id;
            $data->no_arsip                 = $data->getKodeArsipPpat();
            $data->no_akta                  = $request->no_akta;

            $file = $request->file('file');
            $fileName = $data->no_arsip;
            $filePath = $file->store('public/' . $fileName);
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
        try {
            if ($arsipPpat->file) {

                $file = $arsipPpat->file;
                if (Storage::exists($file)) {

                    Storage::delete($file);
                    $arsipPpat->delete();
                    return redirect()->route('arsip-ppat.index')->with('success', 'Data arsip ppat berhasil di hapus');
                }
            }

            return redirect()->route('arsip-ppat.index')->with('error', 'Data arsip ppat gagal di hapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function download(Request $request)
    {

        $filename = $request->filename;
        $filePath = storage_path('app/' . $filename);

        // dd($filename, $filePath);
        if (file_exists($filePath)) {
            // dd('oke');
            $headers = [

                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
                'Content-Length' => strlen($filePath),
                'Content-Type' => 'application/image',
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
