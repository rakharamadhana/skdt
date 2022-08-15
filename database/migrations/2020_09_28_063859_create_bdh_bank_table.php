<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdhBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdh_bank', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_bdh_bank', 50)->primary();
            $table->string('kode_bank', 32)->nullable();
            $table->string('nm_bank', 128)->nullable();
            $table->boolean('is_tunai')->nullable();
            $table->string('nomor_rekening', 128)->nullable();
            $table->float('saldo_bank', 10, 0)->nullable();
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
        Schema::dropIfExists('bdh_bank');
    }
}
