<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuSiswaSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_siswa_sekolah', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_siswa_sekolah', 50)->primary();
            $table->string('id_keu_kelompok_kelas', 50)->comment('FK keu_kelompok_kelas.id_keu_kelompok_kelas');
            $table->boolean('tingkat')->nullable()->comment('Diisi 7,8,9 atau 10,11,12');
            $table->boolean('tingkat_kelas')->nullable()->comment('Diisi 1,2,3');
            $table->integer('jumlah_siswa')->nullable();
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
        Schema::dropIfExists('keu_siswa_sekolah');
    }
}
