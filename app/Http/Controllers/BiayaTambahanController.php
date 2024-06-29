<?php

namespace App\Http\Controllers;

use App\Models\BiayaTambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiayaTambahanController extends Controller
{
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'nama_biaya' => 'required',
            'nominal' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()->toArray()], 422);
        }

        try {
            $biaya = BiayaTambahan::create([
                'nama_biaya' => $request->nama_biaya,
                'nominal' => $request->nominal,
                'ppat_id' => $request->ppat_id,
            ]);
            return response()->json(['success' => 'Data tersimpan'], 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        $biaya = BiayaTambahan::find($id);
        $biaya->delete();

        return back()->with('success', 'Data terhapus');
    }
}
