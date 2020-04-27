<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsalPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asal_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->string("nama_tempat");
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
        Schema::dropIfExists('asal_pengiriman');
        Schema::dropIfExists('tujuan_non_makanan');
        Schema::dropIfExists('tujuan_makanan');
    }
}
