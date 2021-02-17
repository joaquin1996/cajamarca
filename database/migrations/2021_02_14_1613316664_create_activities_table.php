<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {

            $table->bigIncrements('id');
		    $table->bigInteger('id_category',false)->unsigned();
		    $table->text('name');
		    $table->text('description')->nullable();
		    $table->text('icon')->nullable();
		    $table->decimal('distance', 10,5)->nullable();
		    $table->decimal('duration', 10,5)->nullable();
		    $table->integer('dificulty',)->nullable();
		    $table->text('perfil')->nullable();
		    $table->bigInteger('id_point_a',false)->unsigned();
		    $table->bigInteger('id_point_b',false)->unsigned();
		    $table->foreign('id_category')->references('id')->on('categories')->onDelete( 'cascade' )->onUpdate( 'cascade' );
            $table->foreign('id_point_a')->references('id')->on('points')->onDelete( 'cascade' )->onUpdate( 'cascade' );
            $table->foreign('id_point_b')->references('id')->on('points')->onDelete( 'cascade' )->onUpdate( 'cascade' );
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
