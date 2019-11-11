<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_dokumen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_kategori');
            $table->integer('id_objek');
            $table->string('nama_dokumen')->nullable();
            $table->string('nama_file');
            $table->string('nama_original');
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
        Schema::dropIfExists('attachment_dokumen');
    }
}
