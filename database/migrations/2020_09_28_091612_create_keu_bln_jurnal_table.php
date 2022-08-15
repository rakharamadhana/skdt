<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuBlnJurnalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_bln_jurnal', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_bln_jurnal', 50)->primary();
            $table->string('id_sekolah', 50)->comment('FK sekolah.id_sekolah');
            $table->string('id_keu_bln_realisasi', 50)->comment('FK keu_bln_realisasi.id_keu_bln_realisasi');
            $table->date('tgl_bln_jurnal')->nullable();
            $table->float('debit', 10, 0)->nullable();
            $table->float('kredit', 10, 0)->nullable();
            $table->float('saldo_akhir', 10, 0)->nullable();
            $table->string('keterangan_bln_jurnal', 1024)->nullable();
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
        Schema::dropIfExists('keu_bln_jurnal');
    }
}
