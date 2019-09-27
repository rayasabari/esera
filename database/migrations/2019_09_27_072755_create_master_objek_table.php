<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterObjekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_objek', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_kategori');
            $table->integer('id_pemilik');
            $table->string('nama');
            $table->longtext('deskripsi');
            $table->double('luas_tanah');
            $table->double('luas_bangunan');
            $table->double('harga_limit');
            $table->double('jaminan');
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
        Schema::dropIfExists('master_objek');
    }
}
