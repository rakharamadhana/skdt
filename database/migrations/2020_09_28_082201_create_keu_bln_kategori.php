<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuBlnKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_bln_kategori', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_bln_kategori', 50)->primary();
            $table->string('id_keu_bln_kelompok', 50)->comment('FK keu_bln_kelompok.id_bln_kelompok');
            $table->string('kode_bln_kategori', 32)->nullable();
            $table->string('nm_bln_kategori', 128)->nullable();
            $table->string('deskripsi_bln_kategori', 1024)->nullable();
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
        Schema::dropIfExists('keu_bln_kategori');
    }
}
