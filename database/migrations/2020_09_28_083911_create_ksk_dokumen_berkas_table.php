<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskDokumenBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_dokumen_berkas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_dokumen_berkas', 50)->primary();
            $table->string('id_ksk_dokumen', 50)->comment('FK: ksk_dokumen.id_ksk_dokumen');

            $table->string('path_dokumen_berkas', 2048)->nullable();
            $table->string('nm_file_dokumen_berkas', 1024)->nullable();

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
        Schema::dropIfExists('ksk_dokumen_berkas');
    }
}
