<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuKelompokKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_kelompok_kelas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_kelompok_kelas', 50)->primary();
            $table->string('id_sekolah', 50)->comment('FK sekolah.id_sekolah');
            $table->string('nm_kelompok_kelas', 128)->nullable();
            $table->integer('jumlah_siswa')->nullable();
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
        Schema::dropIfExists('keu_kelompok_kelas');
    }
}
