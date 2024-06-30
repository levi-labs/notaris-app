<?php

namespace App\Http\Controllers;

use App\Models\BiayaTambahanNotaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiayaTambahanNotarisController extends Controller
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
            $biaya = BiayaTambahanNotaris::create([
                'nama_biaya' => $request->nama_biaya,
                'nominal' => $request->nominal,
                'notaris_id' => $request->notaris_id,
                'status' => 'belum lunas',
            ]);
            return response()->json(['success' => 'Data tersimpan'], 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        $biaya = BiayaTambahanNotaris::find($id);
        $biaya->delete();

        return back()->with('success', 'Data terhapus');
    }
}
