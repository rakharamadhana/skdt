<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskKelompokDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_kelompok_dokumen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_kelompok_dokumen', 50)->primary();
            $table->string('kode_kelompok_dokumen', 32)->nullable();
            $table->string('nm_kelompok_dokumen', 128)->nullable()->comment('kelompok tempat dokumen, misal: Panjunan, Bringinbendo, dll');
            $table->string('deskripsi_kelompok_dokumen', 1024)->nullable();

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
        Schema::dropIfExists('ksk_kelompok_dokumen');
    }
}
