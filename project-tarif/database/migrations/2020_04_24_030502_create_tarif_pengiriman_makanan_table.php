<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifPengirimanMakananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarif_pengiriman_makanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_asal_pengiriman");
            $table->foreignId("id_tujuan_makanan_non_makanan");
            $table->float("harga_awal", 11, 1);
            $table->float("harga_selanjutnya", 11 , 1);
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
        Schema::dropIfExists('tarif_pengiriman_makanan');
    }
}
