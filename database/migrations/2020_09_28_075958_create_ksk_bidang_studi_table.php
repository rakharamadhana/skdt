<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskBidangStudiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_bidang_studi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_bidang_studi', 50)->primary();
            $table->string('kode_bidang_studi', 32)->nullable();
            $table->string('nm_bidang_studi', 128)->nullable();
            $table->string('deskripsi_bidang_studi', 1024)->nullable();

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
        Schema::dropIfExists('ksk_bidang_studi');
    }
}
