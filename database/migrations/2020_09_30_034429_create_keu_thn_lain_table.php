<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuThnLainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_thn_lain', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_thn_lain', 50)->primary();
            $table->string('id_keu_thn_isi', 50)->comment('FK keu_thn_isi.id_keu_thn_isi');
            $table->boolean('waktu_pungutan')->nullable()->comment('1 = Bulanan x12; 2 = Semester Ganjil; 3 = Semester Genap/Unas');
            $table->float('nominal_pungutan', 10, 0)->nullable();
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
        Schema::dropIfExists('keu_thn_lain');
    }
}
