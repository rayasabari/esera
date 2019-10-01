<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_kendaraan', function (Blueprint $table) {
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
            $table->integer('id_jenis_kendaraan')->nullable();
            $table->string('merk', 50)->nullable();
            $table->string('tipe', 50)->nullable();
            $table->string('tahun_pembuatan', 4)->nullable();
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
        Schema::dropIfExists('objek_kendaraan');
    }
}
