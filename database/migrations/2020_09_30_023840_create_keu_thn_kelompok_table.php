<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuThnKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_thn_kelompok', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_thn_kelompok', 50)->primary();
            $table->string('kode_thn_kelompok', 32)->nullable();
            $table->string('nm_thn_kelompok', 128)->nullable();
            $table->string('deskripsi_thn_kelompok', 1024)->nullable();
            $table->integer('urutan_thn_kelompok')->nullable();
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
        Schema::dropIfExists('keu_thn_kelompok');
    }
}
