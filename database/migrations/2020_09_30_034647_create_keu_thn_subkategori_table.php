<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuThnSubkategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_thn_subkategori', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_thn_subkategori', 50)->primary();
            $table->string('id_keu_thn_kategori', 50)->comment('FK keu_thn_kategori.id_keu_thn_kategori');
            $table->string('kode_thn_subkategori', 32)->nullable();
            $table->string('nm_thn_subkategori', 128)->nullable();
            $table->string('deskripsi_thn_subkategori', 1024)->nullable();
            $table->integer('urutan_thn_subkategori')->nullable();
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
        Schema::dropIfExists('keu_thn_subkategori');
    }
}
