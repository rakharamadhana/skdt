<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdhRealisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdh_realisasi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_bdh_realisasi', 50)->primary();
            $table->string('id_bdh_posting', 50)->comment('FK bdh_posting.id_bdh_posting');
            $table->string('id_sekolah', 50)->comment('FK sekolah.id_sekolah');
            $table->string('id_bdh_bank', 50)->comment('FK bdh_bank.id_bdh_bank');
            $table->boolean('nomor_seq')->nullable();
            $table->string('catatan_realisasi', 1024)->nullable();
            $table->float('dana_realisasi', 10, 0)->nullable();
            $table->date('tgl_realisasi')->nullable();
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
        Schema::dropIfExists('bdh_realisasi');
    }
}
