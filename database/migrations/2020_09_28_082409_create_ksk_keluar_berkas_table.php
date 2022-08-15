<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskKeluarBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_keluar_berkas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_keluar_berkas', 50)->primary();
            $table->string('id_ksk_surat_keluar', 50)->comment('FK: ksk_surat_masuk.id_ksk_surat_masuk');

            $table->string('path_keluar_berkas', 2048)->nullable();
            $table->string('nm_file_keluar_berkas', 1024)->nullable();

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
        Schema::dropIfExists('ksk_keluar_berkas');
    }
}
