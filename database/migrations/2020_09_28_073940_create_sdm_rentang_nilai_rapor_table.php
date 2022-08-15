<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmRentangNilaiRaporTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm_rentang_nilai_rapor', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_sdm_rentang_nilai_rapor', 50)->primary();
            $table->string('nm_rentang_nilai_rapor', 128)->nullable();
            $table->float('batas_bawah', 10, 0)->nullable();
            $table->float('batas_atas', 10, 0)->nullable();

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
        Schema::dropIfExists('sdm_rentang_nilai_rapor');
    }
}
