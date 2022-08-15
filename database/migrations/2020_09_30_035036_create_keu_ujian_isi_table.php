<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuUjianIsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_ujian_isi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_ujian_isi', 50)->primary();
            $table->string('id_tahun_ajaran', 50)->comment('FK tahun_ajaran.id_tahun_ajaran');
            $table->string('id_sekolah', 50)->comment('FK sekolah.id_sekolah');
            $table->string('id_keu_ujian_kelompok', 50)->comment('FK keu_ujian_kelompok.id_keu_ujian_kelompok');
            $table->string('id_keu_ujian_kategori', 50)->nullable()->comment('FK keu_ujian_kategori.id_keu_ujian_kategori');
            $table->string('id_keu_ujian_subkategori', 50)->nullable()->comment('FK keu_ujian_subkategori.id_keu_ujian_subkategori');
            $table->float('nominal_kali_1', 10, 0)->nullable();
            $table->float('nominal_kali_2', 10, 0)->nullable();
            $table->float('nominal_satuan', 10, 0)->nullable();
            $table->float('nominal_total', 10, 0)->nullable();
            $table->boolean('jenis_ujian')->nullable()->comment('1 = Gasal Berbasis Paper; 2 = Gasal Berbasis Komputer; 3 = Genap Berbasis Paper; 4 = Genap Berbasis Komputer; 5 = Unas');
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
        Schema::dropIfExists('keu_ujian_isi');
    }
}
