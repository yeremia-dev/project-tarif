<?php

namespace App\Http\Controllers\API;

use App\AsalPengiriman;
use App\BeratDokumen;
use App\Http\Controllers\Controller;
use App\Kategori;
use App\TujuanDokumen;
use App\TujuanMakanan;
use App\TujuanMakananNonMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseDataController extends Controller
{
    public function getAsalPengiriman()
    {
        $asal_pengiriman = AsalPengiriman::all();
        return response()->json($asal_pengiriman->toArray());
    }

    public function  getBeratDokumen()
    {
        $berat_dokumen = BeratDokumen::all();
        return response()->json($berat_dokumen->toArray());
    }

    public function getTujuanDokumen()
    {
        $tujuan_dokumen = TujuanDokumen::all();
        return response()->json($tujuan_dokumen->toArray());
    }

    public function getTujuanMakananNonMakanan()
    {
        $tujuan_makanan_non_makanan = TujuanMakananNonMakanan::all();
        return response()->json($tujuan_makanan_non_makanan->toArray());
    }

    public function getTujuanMakanan()
    {
        $tujuan_makanan = TujuanMakanan::all();
        return response()->json($tujuan_makanan->toArray());
    }

    public function getKategori()
    {
        $kategori = Kategori::all();
        return response()->json($kategori->toArray());
    }

    public function findKategori(Request $request)
    {
        $kategori = DB::table('kategori_paket')
            ->select('kategori')
            ->where('id', $request['id'])->get();
        return response()->json($kategori->toArray());
    }

    public function findAsalPengiriman(Request $request)
    {
        $asal_pengiriman = DB::table('asal_pengiriman')
            ->select('nama_tempat')
            ->where('id', $request['id'])->get();
        return response()->json($asal_pengiriman->toArray());
    }

    public function findBeratDokumen(Request $request)
    {
        $berat_dokumen = DB::table('berat_dokumen')
            ->select('berat')
            ->where('id', $request['id'])->get();
        return response()->json($berat_dokumen->toArray());
    }

    public function findTujuanDokumen(Request $request)
    {
        $tujuan_dokumen = DB::table('tujuan_dokumen')
            ->select('nama_tempat')
            ->where('id', $request['id'])->get();
        return response()->json($tujuan_dokumen->toArray());
    }

    public function findTujuanMakanan(Request $request)
    {
        $tujuan_makanan_non_makanan = DB::table('tujuan_makanan')
            ->select('nama_tempat')
            ->where('id', $request['id'])->get();
        return response()->json($tujuan_makanan_non_makanan->toArray());
    }

    public function findTujuanNonMakanan(Request $request)
    {
        $tujuan_makanan_non_makanan = DB::table('tujuan_makanan_non_makanan')
            ->select('nama_tempat')
            ->where('id', $request['id'])->get();
        return response()->json($tujuan_makanan_non_makanan->toArray());
    }

}
