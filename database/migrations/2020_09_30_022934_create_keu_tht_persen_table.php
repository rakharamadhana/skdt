<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuThtPersenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_tht_persen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_tht_persen', 50)->primary();
            $table->float('masa_rentang_awal', 10 ,0)->nullable()->comment('masa kerja');
            $table->float('masa_rentang_akhir', 10, 0)->nullable()->comment('masa kerja');
            $table->float('nominal_tht_persen', 10, 0)->nullable()->comment('nominal persentase dari gaji sesuai masa kerja');
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
        Schema::dropIfExists('keu_tht_persen');
    }
}
