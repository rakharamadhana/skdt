<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmPengajuanRekrutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm_pengajuan_rekrut', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_sdm_pengajuan_rekrut', 50)->primary();
            $table->string('id_sekolah', 50)->comment('FK: sekolah.id_sekolah');
            $table->string('id_pengguna_pengajuan', 50)->comment('FK: pengguna.id_pengguna');
            $table->string('id_semester', 50)->nullable()->comment('FK: semester.id_semester');

            $table->string('nm_pengajuan_rekrut', 128)->nullable();
            $table->date('tgl_pengajuan_rekrut')->nullable();
            $table->string('deskripsi_pengajuan_rekrut', 1024)->nullable();
            $table->date('tgl_approve_pengajuan')->nullable();
            $table->string('id_pengguna_approve', 50)->nullable()->comment('FK: pengguna.id_pengguna');
            $table->boolean('status_approve_pengajuan')->nullable()->comment('1 = Pengajuan; 2 = Approve; 3 = Pending; 99 = Ditolak;');

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
        Schema::dropIfExists('sdm_pengajuan_rekrut');
    }
}
