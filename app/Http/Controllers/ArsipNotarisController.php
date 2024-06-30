<?php

namespace App\Http\Controllers;

use App\Models\ArsipNotaris;
use App\Models\Notaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArsipNotarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Arsip Notaris';
        $data = ArsipNotaris::all();

        return view('pages.arsip-notaris.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = null)
    {
        $title = 'Form Arsip Notaris';
        if ($id) {
            $notaris = Notaris::find($id);
            $notaris_id = $notaris->id;
            $layanan_permohonan_id = $notaris->layanan_permohonan_id;
            return view('pages.arsip-notaris.create', compact('title', 'notaris', 'notaris_id', 'layanan_permohonan_id'));
        } else {
            $notaris = DB::table('notaris')
                ->select('notaris.*')
                ->leftJoin('arsip_notaris', 'notaris.id', '=', 'arsip_notaris.notaris_id')
                ->whereNull('arsip_notaris.notaris_id')
                ->get();

            // dd(is_object($ppat));
            return view('pages.arsip-notaris.create', compact('title', 'notaris'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'notaris_id' => 'required',
            'no_akta' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $layanan_id = Notaris::where('id', $request->notaris_id)->first();

            $data                           = new ArsipNotaris();
            $data->notaris_id               = $request->notaris_id;
            $data->layanan_permohonan_id    = $request->layanan_permohonan_id ?? $layanan_id->layanan_permohonan_id;
            $data->no_arsip                 = $data->getKodeArsipNotaris();
            $data->no_akta                  = $request->no_akta;
            $file = $request->file('file');
            $fileName = $data->no_arsip;
            $filePath = $file->store('public/' . $fileName);
            $data->file = $filePath;
            $data->save();

            return redirect()->route('arsip-notaris.index')->with(['success' => 'Arsip Notaris Berhasil']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArsipNotaris $arsipNotaris)
    {
        try {
            if ($arsipNotaris->file) {
                $file = $arsipNotaris->file;
                if (Storage::exists($file)) {

                    Storage::delete($file);
                    $arsipNotaris->delete();
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
