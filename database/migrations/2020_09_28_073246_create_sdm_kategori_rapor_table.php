<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmKategoriRaporTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm_kategori_rapor', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_sdm_kategori_rapor', 50)->primary();
            $table->string('kode_kategori_rapor', 32)->nullable();
            $table->string('nm_kategori_rapor', 128)->nullable();
            $table->string('deskripsi_kategori_rapor', 1024)->nullable();

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
        Schema::dropIfExists('sdm_kategori_rapor');
    }
}
