<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdhBankJurnalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdh_bank_jurnal', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_bdh_bank_jurnal', 50)->primary();
            $table->string('id_bdh_bank', 50)->comment('FK bdh_bank.id_bdh_bank');
            $table->string('id_bdh_realisasi', 50)->comment('FK bdh_realisasi.id_bdh_realisasi');
            $table->date('tgl_bank_jurnal')->nullable();
            $table->float('debit', 10, 0)->nullable();
            $table->float('kredit', 10, 0)->nullable();
            $table->float('saldo_akhir', 10, 0)->nullable();
            $table->string('keterangan_bank_jurnal', 1024)->nullable();
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
        Schema::dropIfExists('bdh_bank_jurnal');
    }
}
