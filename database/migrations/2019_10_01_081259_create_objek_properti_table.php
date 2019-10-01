<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekPropertiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_properti', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_kategori');
            $table->integer('id_sub_kategori');
            $table->string('nama', 80)->nullable();
            $table->string('alamat')->nullable();
            $table->integer('id_kelurahan')->nullable();
            $table->integer('id_kecamatan')->nullable();
            $table->integer('id_kota')->nullable();
            $table->integer('id_provinsi')->nullable();
            $table->string('kode_pos', 8)->nullable();
            $table->string('tipe', 30)->nullable();
            $table->double('luas_tanah')->nullable();
            $table->double('luas_bangunan')->nullable();
            $table->double('luas_unit')->nullable();
            $table->double('jumlah_lantai')->nullable();
            $table->double('kamar_tidur')->nullable();
            $table->double('kamar_mandi')->nullable();
            $table->integer('id_sertifikat')->nullable();
            $table->integer('id_pemilik')->nullable();
            $table->string('deskripsi')->nullable();
            $table->double('harga_limit')->nullable();
            $table->double('jaminan')->nullable();
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
        Schema::dropIfExists('objek_properti');
    }
}
