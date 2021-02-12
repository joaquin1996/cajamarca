<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {

		$table->bigIncrements('id');;
		$table->string('name',30);
        $table->string('description',30);
        $table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();


        });
    }

    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
