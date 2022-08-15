<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuBlnRealisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_bln_realisasi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_bln_realisasi', 50)->primary();
            $table->string('id_sekolah', 50)->comment('FK sekolah.id_sekolah');
            $table->string('id_keu_bln_kelompok', 50)->nullable()->comment('FK keu_bln_kelompok.id_keu_bln_kelompok');
            $table->string('id_keu_bln_kategori', 50)->nullable()->comment('FK keu_bln_kategori.id_keu_bln_kategori');
            $table->string('id_keu_bln_subkategori', 50)->nullable()->comment('FK keu_bln_subkategori.id_keu_bln_subkategori');
            $table->date('tgl_bln_realisasi')->nullable();
            $table->float('nominal_bln_realisasi', 10, 0)->nullable();
            $table->boolean('tipe_bln_realisasi')->nullable()->comment('1 = Penerimaan; 2 = Pengeluaran');
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
        Schema::dropIfExists('keu_bln_realisasi');
    }
}
