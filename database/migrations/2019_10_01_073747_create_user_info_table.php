<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_status_user');
            $table->integer('id_user');
            $table->longtext('alamat');
            $table->integer('id_kelurahan');
            $table->integer('id_kecamatan');
            $table->integer('id_kota');
            $table->integer('id_provinsi');
            $table->string('kode_pos', 6);
            $table->string('no_telepon', 15);
            $table->string('no_fax', 15);
            $table->string('no_ktp', 18);
            $table->string('npwp', 18);
            $table->string('no_rekening', 18);
            $table->string('nama_bank', 50);
            $table->string('cabang_bank', 50);
            $table->string('atas_nama_bank', 50);
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
        Schema::dropIfExists('user_info');
    }
}
