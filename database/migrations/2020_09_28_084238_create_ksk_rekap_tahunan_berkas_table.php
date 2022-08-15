<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskRekapTahunanBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_rekap_tahunan_berkas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_rekap_tahunan_berkas', 50)->primary();
            $table->string('id_ksk_rekap_tahunan', 50)->comment('FK: ksk_rekap_tahunan.id_ksk_rekap_tahunan');

            $table->string('path_rekap_tahunan_berkas', 2048)->nullable();
            $table->string('nm_file_rekap_tahunan_berkas', 1024)->nullable();

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
        Schema::dropIfExists('ksk_rekap_tahunan_berkas');
    }
}
