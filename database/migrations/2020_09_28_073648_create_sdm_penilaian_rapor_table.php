<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmPenilaianRaporTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm_penilaian_rapor', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_sdm_penilaian_rapor', 50)->primary();
            $table->string('id_sdm_ptk', 50)->comment('FK: sdm_ptk.id_sdm_ptk');
            $table->string('id_semester', 50)->comment('FK: semester.id_semester');
            $table->string('id_sdm_subkategori_rapor', 50)->comment('FK: sdm_subkategori_rapor.id_sdm_subkategori_rapor');

            $table->float('nilai_rapor', 10, 0)->nullable();

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
        Schema::dropIfExists('sdm_penilaian_rapor');
    }
}
