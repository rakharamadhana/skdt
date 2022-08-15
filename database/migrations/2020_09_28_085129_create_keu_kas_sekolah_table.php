<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuKasSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_kas_sekolah', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_kas_sekolah', 50)->primary();
            $table->string('id_sekolah', 50)->comment('FK sekolah.id_sekolah');
            $table->boolean('id_bulan', 50)->nullable();
            $table->integer('tahun')->nullable();
            $table->float('nominal_kas_sekolah', 10, 0)->nullable();
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
        Schema::dropIfExists('keu_kas_sekolah');
    }
}
