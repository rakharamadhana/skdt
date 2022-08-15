<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuBlnSubkategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_bln_subkategori', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_bln_subkategori', 50)->primary();
            $table->string('id_keu_bln_kategori', 50)->comment('FK keu_bln_kategori.id_keu_bln_kategori');
            $table->string('kode_bln_subkategori', 32)->nullable();
            $table->string('nm_bln_subkategori', 128)->nullable();
            $table->string('deskripsi_bln_subkategori', 1024)->nullable();
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
        Schema::dropIfExists('keu_bln_subkategori');
    }
}
