<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdhTutupBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdh_tutup_buku', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_bdh_tutup_buku', 50)->primary();
            $table->string('id_bdh_bank', 50)->comment('FK bdh_bank.id_bdh_bank');
            $table->boolean('id_bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->float('saldo_akhir_bank', 10, 0)->nullable();
            $table->float('saldo_akhir_sistem', 10, 0)->nullable();
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
        Schema::dropIfExists('bdh_tutup_buku');
    }
}
