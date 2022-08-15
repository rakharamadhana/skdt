<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmKategoriBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm_kategori_berkas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_sdm_kategori_berkas', 50)->primary();
            $table->string('kode_kategori_berkas', 32)->nullable();
            $table->string('nm_kategori_berkas', 128)->nullable();
            $table->string('deskripsi_kategori_berkas', 1024)->nullable();

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
        Schema::dropIfExists('sdm_kategori_berkas');
    }
}
