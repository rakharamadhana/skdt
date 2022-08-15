<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_dokumen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_dokumen', 50)->primary();
            $table->string('id_ksk_kategori_dokumen', 50)->comment('FK: ksk_kategori_dokumen.id_ksk_kategori_dokumen');

            $table->string('id_ksk_kelompok_dokumen', 50)->nullable()->comment('FK: ksk_kelompok_dokumen.id_ksk_kelompok_dokumen');

            $table->string('nm_dokumen', 256)->nullable();
            $table->string('deskripsi_dokumen', 1024)->nullable();

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
        Schema::dropIfExists('ksk_dokumen');
    }
}
