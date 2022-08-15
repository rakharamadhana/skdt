<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuBlnThtIsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_bln_tht_isi', function (Blueprint $table) {
            $table->string('id_keu_bln_tht_isi', 50)->primary();
            $table->string('id_tahun_ajaran', 50)->comment('FK tahun_ajaran.id_tahun_ajaran');
            $table->string('id_sdm_ptk', 50)->comment('FK sdm_ptk.id_sdm_ptk');
            $table->string('id_keu_tht_persen', 50)->comment('FK keu_tht_persen.id_keu_tht_persen');
            $table->string('id_keu_tht_hr_jam', 50)->comment('FK keu_tht_hr_jam.id_keu_tht_hr_jam');
            $table->float('tunjangan_jabatan_wajib', 10, 0)->nullable();
            $table->float('tunjangan_jabatan_tambahan', 10, 0)->nullable();
            $table->float('jam_mengajar_wajib', 10, 0)->nullable();
            $table->float('jam_mengajar_tambahan', 10, 0)->nullable();
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
        Schema::dropIfExists('keu_bln_tht_isi');
    }
}
