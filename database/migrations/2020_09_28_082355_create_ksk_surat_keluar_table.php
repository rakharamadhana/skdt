<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_surat_keluar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_surat_keluar', 50)->primary();
            $table->string('id_ksk_kategori_keluar', 50)->comment('FK: ksk_kategori_keluar.id_ksk_kategori_keluar');

            $table->string('nomor_urut_surat_keluar', 32)->nullable();
            $table->string('nomor_surat_keluar', 256)->nullable()->comment('otomatis generate sistem');
            $table->date('tgl_surat_keluar')->nullable();
            $table->string('perihal_surat_keluar', 512)->nullable();
            $table->string('lampiran_surat_keluar', 64)->nullable();

            $table->string('id_sekolah_tujuan', 50)->nullable()->comment('FK: sekolah.id_sekolah, diisi apabia tujuan surat ke sekolah');
            $table->string('nm_tujuan_surat_keluar', 128)->nullable()->comment('diisi apabila tujuan surat bukan ke sekolah');

            $table->string('keterangan_surat_keluar', 1024)->nullable();

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
        Schema::dropIfExists('ksk_surat_keluar');
    }
}
