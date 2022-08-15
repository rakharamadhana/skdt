<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuUjianKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_ujian_kelompok', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_ujian_kelompok', 50)->primary();
            $table->string('kode_ujian_kelompok', 32)->nullable();
            $table->string('nm_keu_ujian_kelompok', 128)->nullable();
            $table->string('deskripsi_keu_ujian_kelompok', 1024)->nullable();
            $table->boolean('tipe_keu_ujian_kelompok')->nullable()->comment('1 = penerimaan; 2 = pengeluaran');
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
        Schema::dropIfExists('keu_ujian_kelompok');
    }
}
