<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTarifController extends Controller
{
    public function getTarifDokumen(Request $request)
    {
        $tarif_dokumen = DB::table('tarif_pengiriman_dokumen')
            ->select('harga')
            ->where('id_asal_pengiriman', $request['asal'])
            ->where('id_tujuan_dokumen', $request['tujuan'])
            ->where('id_berat_dokumen', $request['berat'])
            ->get();
        return response()->json($tarif_dokumen->toArray());
    }

    public function  getTarifMakanan(Request $request)
    {
        $tarif_makanan = DB::table('tarif_pengiriman_makanan')
            ->select('harga_awal', 'harga_selanjutnya')
            ->where('id_asal_pengiriman', $request['asal'])
            ->where('id_tujuan_makanan_non_makanan', $request['tujuan'])
            ->get();
        return response()->json($tarif_makanan->toArray());
    }

    public function getTarifNonMakanan(Request $request)
    {
        $tarif_non_makanan = DB::table('tarif_pengiriman_non_makanan')
            ->select('harga_awal', 'harga_selanjutnya')
            ->where('id_asal_pengiriman', $request['asal'])
            ->where('id_tujuan_makanan_non_makanan', $request['tujuan'])
            ->get();
        return response()->json($tarif_non_makanan->toArray());
    }

}
