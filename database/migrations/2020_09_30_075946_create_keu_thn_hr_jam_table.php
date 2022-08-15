<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuThnHrJamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_thn_hr_jam', function (Blueprint $table) {
            $table->string('id_keu_thr_jam', 50)->primary();
            $table->float('masa_rentang_awal', 10, 0)->nullable()->comment('Masa kerja');
            $table->float('masa_rentang_akhir', 10, 0)->nullable()->comment('Masa kerja');
            $table->float('nominal_keu_thn_hr_jam', 10, 0)->nullable()->comment('nominal hr per jam sesuai masa kerja');
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
        Schema::dropIfExists('keu_thn_hr_jam');
    }
}
