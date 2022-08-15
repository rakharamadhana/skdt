<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuBlnIsiLampiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_bln_isi_lampiran', function (Blueprint $table) {
            $table->string('id_keu_bln_isi_lampiran', 50)->primary();
            $table->string('id_tahun_ajaran', 50)->comment('FK tahun_ajaran.id_tahun_ajaran');
            $table->string('id_keu_siswa_sekolah', 50)->comment('FK keu_siswa_sekolah.id_keu_siswa_sekolah');
            $table->string('nm_jenis_pungutan', 1024)->nullable();
            $table->float('nominal_pungutan', 10, 0)->nullable();
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
        Schema::dropIfExists('keu_bln_isi_lampiran');
    }
}
