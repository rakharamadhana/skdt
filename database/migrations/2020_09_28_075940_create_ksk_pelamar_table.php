<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKskPelamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksk_pelamar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_ksk_pelamar', 50)->primary();
            $table->string('id_ksk_bidang_studi', 50)->comment('FK: ksk_bidang_studi.id_ksk_bidang_studi');

            $table->string('id_sdm_pengajuan_rekrut', 50)->nullable()->comment('FK: sdm_pengajuan_rekrut.id_sdm_pengajuan_rekrut, diisi saat diterima oleh SDM');

            $table->string('nm_pelamar', 256)->nullable();
            $table->date('tgl_masuk_pelamar')->nullable();
            $table->string('alamat_pelamar', 2048)->nullable();
            $table->string('nomor_hp_pelamar', 32)->nullable();
            $table->string('nomor_telp_pelamar', 32)->nullable();
            $table->string('asal_universitas_pelamar', 256)->nullable();
            $table->float('ipk_pelamar', 10, 0)->nullable();
            $table->string('keterangan_pelamar', 1024)->nullable();
            $table->boolean('status_pelamar')->nullable()->comment('1 = Pengajuan; 2 = Approve; 3 = Pending; 99 = Ditolak;');

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
        Schema::dropIfExists('ksk_pelamar');
    }
}
