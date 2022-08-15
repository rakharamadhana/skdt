<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmPtkBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm_ptk_berkas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_sdm_ptk_berkas', 50)->primary();
            $table->string('id_sdm_ptk', 50)->comment('FK: sdm_ptk.id_sdm_ptk');
            $table->string('id_sdm_kategori_berkas', 50)->comment('FK: sdm_kategori_berkas.id_sdm_kategori_berkas');
            $table->string('id_sdm_subkategori_berkas', 50)->nullable()->comment('FK: sdm_subkategori_berkas.id_sdm_subkategori_berkas');

            $table->string('path_ptk_berkas', 2048)->nullable();
            $table->string('nm_file_ptk_berkas', 1024)->nullable();

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
        Schema::dropIfExists('sdm_ptk_berkas');
    }
}
