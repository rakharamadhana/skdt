<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuBlnRapbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_bln_rapbs', function (Blueprint $table) {
            $table->string('id_keu_bln_rapbs', 50)->primary();
            $table->string('id_tahun_ajaran', 50)->comment('FK tahun_ajaran.id_tahun_ajaran');
            $table->string('id_sekolah', 50)->comment('FK sekolah.id_sekolah');
            $table->string('id_keu_bln_kelompok', 50)->comment('FK keu_bln_kelompok.id_keu_bln_kelompok');
            $table->string('id_keu_bln_kategori', 50)->nullable()->comment('FK keu_bln_kategori.id_keu_bln_kategori');
            $table->string('id_keu_bln_subkategori', 50)->nullable()->comment('FK keu_bln_subkategori.id_keu_bln_subkategori');
            $table->float('nominal_kali_1', 10, 0)->nullable();
            $table->float('nominal_kali_2', 10, 0)->nullable();
            $table->float('nominal_satuan', 10, 0)->nullable();
            $table->float('nominal_total', 10, 0)->nullable();
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
        Schema::dropIfExists('keu_bln_rapbs');
    }
}
