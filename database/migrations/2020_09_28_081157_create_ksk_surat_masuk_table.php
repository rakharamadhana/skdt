<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_surat_masuk', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_surat_masuk', 50)->primary();
            $table->string('id_ksk_kategori_masuk', 50)->comment('FK: ksk_kategori_masuk.id_ksk_kategori_masuk');

            $table->string('id_sekolah_asal', 50)->nullable()->comment('FK: sekolah.id_sekolah, diisi apabia asal surat dari sekolah');
            $table->string('nm_asal_surat_masuk', 128)->nullable()->comment('diisi apabila asal surat bukan dari sekolah');

            $table->date('tgl_diterima')->nullable();
            $table->string('nomor_surat_masuk', 256)->nullable();
            $table->date('tgl_surat_masuk')->nullable();
            $table->string('lampiran_surat_masuk', 64)->nullable();
            $table->string('perihal_surat_masuk', 512)->nullable();
            $table->string('nomor_agenda', 256)->nullable();
            $table->string('keterangan_surat_masuk', 1024)->nullable();

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
        Schema::dropIfExists('ksk_surat_masuk');
    }
}
