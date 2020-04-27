<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifPengirimanDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarif_pengiriman_dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_asal_pengiriman");
            $table->foreignId("id_tujuan_dokumen");
            $table->foreignId("id_berat_dokumen");
            $table->float("harga", 11, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarif_pengiriman_dokumen');
    }
}
