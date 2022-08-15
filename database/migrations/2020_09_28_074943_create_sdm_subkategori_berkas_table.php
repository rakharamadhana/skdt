<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmSubkategoriBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm_subkategori_berkas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_sdm_subkategori_berkas', 50)->primary();
            $table->string('id_sdm_kategori_berkas', 50)->comment('FK: sdm_kategori_berkas.id_sdm_kategori_berkas');
            $table->string('kode_subkategori_berkas', 32)->nullable();
            $table->string('nm_subkategori_berkas', 128)->nullable();
            $table->string('deskripsi_subkategori_berkas', 1024)->nullable();

            $table->timestamps();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->softDeletes();
            $table->string('deleted_by', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sdm_subkategori_berkas');
    }
}
