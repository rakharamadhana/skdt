<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdhPostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdh_posting', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_bdh_posting', 50)->primary();
            $table->string('kode_posting', 32)->nullable();
            $table->string('nm_posting', 128)->nullable();
            $table->string('deskripsi_posting', 1024)->nullable();
            $table->boolean('tipe_posting')->nullable()->comment('1 = penerimaan; 2 = pengeluaran');
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
        Schema::dropIfExists('bdh_posting');
    }
}
