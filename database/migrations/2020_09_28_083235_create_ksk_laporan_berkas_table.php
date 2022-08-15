<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskLaporanBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_laporan_berkas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_laporan_berkas', 50)->primary();
            $table->string('id_ksk_laporan', 50)->comment('FK: ksk_laporan.id_ksk_laporan');

            $table->string('path_laporan_berkas', 2048)->nullable();
            $table->string('nm_file_laporan_berkas', 1024)->nullable();

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
        Schema::dropIfExists('ksk_laporan_berkas');
    }
}
