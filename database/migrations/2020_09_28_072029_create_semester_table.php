<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_semester', 50)->primary();
            $table->string('id_tahun_ajaran', 50)->comment('FK: tahun_ajaran.id_tahun_ajaran');

            $table->string('nm_semester', 64)->nullable();
            $table->integer('thn_akademik_semester')->nullable();
            $table->boolean('is_aktif_semester')->nullable()->comment('0 = semester tidak aktif; 1 = semester yg sedang aktif;');
            $table->string('kode_semester', 16)->nullable();
            
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
        Schema::dropIfExists('semester');
    }
}
