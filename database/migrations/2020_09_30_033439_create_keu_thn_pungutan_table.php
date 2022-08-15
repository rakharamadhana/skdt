<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuThnPungutanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keu_thn_pungutan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_keu_thn_pungutan', 50)->primary();
            $table->string('id_keu_thn_kategori', 50)->comment('FK keu_thn_kategori.id_keu_thn_kategori');
            $table->string('id_keu_thn_subkategori', 50)->nullable()->comment('FK keu_thn_subkategori.id_keu_thn_subkategori');
            $table->boolean('tingkat_kelas', 1)->nullable()->comment('Diisi 1,2,3');
            $table->boolean('is_ngelom')->nullable();
            $table->float('nominal_thn_pungutan', 10, 0)->nullable();
            $table->string('keterangan_thn_pungutan', 1024)->nullable();
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
        Schema::dropIfExists('keu_thn_pungutan');
    }
}
