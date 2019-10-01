<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_objek');
            $table->string('kode_lot', 20);
            $table->date('batas_akhir_jaminan');
            $table->double('kelipatan_bid');
            $table->double('harga_berjalan');
            $table->double('harga_terbentuk');
            $table->date('tgl_mulai_lelang');
            $table->date('tgl_akhir_lelang');
            $table->string('status', 10);
            $table->longText('keterangan');
            $table->integer('dilihat');
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
        Schema::dropIfExists('listing');
    }
}
