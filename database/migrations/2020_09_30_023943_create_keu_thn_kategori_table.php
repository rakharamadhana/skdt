<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuThnKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_thn_kategori', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_thn_kategori', 50)->primary();
            $table->string('id_keu_thn_kelompok', 50)->comment('FK keu_thn_kelompok.id_keu_thn_kelompok');
            $table->string('kode_thn_kategori', 32)->nullable();
            $table->string('nm_thn_kategori', 128)->nullable();
            $table->string('deskripsi_thn_kategori')->nullable();
            $table->integer('urutan_thn_kategori')->nullable();
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
        Schema::dropIfExists('keu_thn_kategori');
    }
}
