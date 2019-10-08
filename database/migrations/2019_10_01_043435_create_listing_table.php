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
            $table->integer('id_kategori');
            $table->integer('id_sub_kategori');
            $table->integer('id_objek');
            $table->string('kode_lot', 20);
            $table->date('batas_akhir_jaminan')->nullable();
            $table->double('kelipatan_bid');
            $table->double('harga_berjalan')->nullable();
            $table->double('harga_terbentuk')->nullable();
            $table->date('tgl_mulai_lelang');
            $table->date('tgl_akhir_lelang');
            $table->string('status', 10)->nullable();
            $table->longText('keterangan')->nullable();
            $table->integer('dilihat')->nullable();
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
