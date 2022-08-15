<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuUjianSubkategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_ujian_subkategori', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_ujian_subkategori', 50)->primary();
            $table->string('id_keu_ujian_kategori', 50)->comment('FK keu_ujian_kategori.id_keu_ujian_kategori');
            $table->string('kode_ujian_subkategori', 32)->nullable();
            $table->string('nm_keu_ujian_subkategori', 128)->nullable();
            $table->string('deskripsi_keu_ujian_subkategori', 1024)->nullable();
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
        Schema::dropIfExists('keu_ujian_subkategori');
    }
}
