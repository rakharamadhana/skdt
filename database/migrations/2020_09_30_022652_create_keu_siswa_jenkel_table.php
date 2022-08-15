<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuSiswaJenkelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_siswa_jenkel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_siswa_jenkel', 50)->primary();
            $table->string('id_keu_siswa_sekolah', 50)->comment('FK keu_siswa_sekolah.id_keu_siswa_sekolah');
            $table->boolean('jenis_kelamin')->nullable();
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
        Schema::dropIfExists('keu_siswa_jenkel');
    }
}
