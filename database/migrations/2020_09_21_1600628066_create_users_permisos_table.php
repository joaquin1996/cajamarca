<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPermisosTable extends Migration
{
    public function up()
    {
        Schema::create('users_permisos', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->bigInteger('idusers',false)->unsigned();
		$table->bigInteger('idpermisos',false)->unsigned();
        $table->timestamp('created_at')->nullable();
		$table->timestamp('updated_at')->nullable();
        $table->foreign('idpermisos')->references('id')->on('permisos')->onDelete( 'cascade' )->onUpdate( 'cascade' );
        $table->foreign('idusers')->references('id')->on('users')->onDelete( 'cascade' )->onUpdate( 'cascade' );
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_permisos');
    }
}