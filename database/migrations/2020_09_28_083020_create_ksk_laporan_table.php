<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_laporan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_laporan', 50)->primary();
            $table->string('id_ksk_kategori_laporan', 50)->comment('FK: ksk_kategori_laporan.id_ksk_kategori_laporan');
            $table->string('id_semester', 50)->comment('FK: semester.id_semester');

            $table->string('nm_ksk_laporan', 256)->nullable();

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
        Schema::dropIfExists('ksk_laporan');
    }
}
