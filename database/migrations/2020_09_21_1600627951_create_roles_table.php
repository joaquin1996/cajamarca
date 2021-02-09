<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('name',30);
		$table->string('description',100)->nullable()->default('NULL');
		$table->tinyInteger('condition',false,1)->default('1')->unsigned();
		$table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
