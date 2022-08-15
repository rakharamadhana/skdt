<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->string('id_pengguna', 50)->primary();
			$table->string('nm_pengguna', 256)->nullable();
			$table->string('email_pengguna', 512)->nullable();
            $table->boolean('status_join_table')->nullable()->comment('1 = SDM; 2 = Kesekretariatan; 3 = Bendahara; 4 = Keuangan 1; 5 = Keuangan 2;');
			$table->string('username', 64)->nullable();
			$table->string('password', 512)->nullable();
            
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
        Schema::dropIfExists('pengguna');
    }
}
