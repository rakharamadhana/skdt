<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuThnIsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_thn_isi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_thn_isi', 50)->primary();
            $table->string('id_tahun_ajaran', 50)->comment('FK tahun_ajaran.id_tahun_ajaran');
            $table->string('id_keu_siswa_sekolah', 50)->comment('FK keu_siswa_sekolah.id_keu_siswa_sekolah');
            $table->string('id_keu_siswa_jenkel', 50)->nullable()->comment('FK keu_siswa_jenkel.id_keu_siswa_jenkel');
            $table->string('id_keu_thn_kategori', 50)->comment('FK keu_thn_kategori.id_keu_thn_kategori');
            $table->string('id_keu_thn_subkategori', 50)->nullable()->comment('FK keu_thn_subkategori.id_keu_thn_subkategori');
            $table->float('nominal_thn_isi', 10, 0)->nullable();
            $table->string('id_keu_thn_pungutan', 50)->nullable()->comment('FK keu_thn_pungutan.id_keu_thn_pungutan');
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
        Schema::dropIfExists('keu_thn_isi');
    }
}
