<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuUjianIsiTingkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_ujian_isi_tingkat', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_ujian_isi_tingkat', 50)->primary();
            $table->string('id_keu_ujian_isi', 50)->comment('FK keu_ujian_isi.id_keu_ujian_isi');
            $table->string('id_keu_siswa_sekolah', 50)->comment('FK keu_siswa_sekolah.id_keu_siswa_sekolah');
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
        Schema::dropIfExists('keu_ujian_isi_tingkat');
    }
}
