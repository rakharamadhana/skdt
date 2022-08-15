<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuBlnRealisasiKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_bln_realisasi_kategori', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_bln_realisasi_kategori', 50)->primary();
            $table->string('id_keu_bln_realisasi', 50)->comment('FK keu_bln_realisasi.id_keu_bln_realisasi');
            $table->string('id_keu_bln_rapbs', 50)->comment('FK keu_bln_rapbs.id_keu_bln_rapbs');
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
        Schema::dropIfExists('keu_bln_realisasi_kategori');
    }
}
