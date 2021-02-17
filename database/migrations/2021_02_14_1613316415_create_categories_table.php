<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            $table->bigIncrements('id');
		    $table->text('name');
		    $table->text('description')->nullable();
		    $table->text('icon')->nullable();
            $table->bigInteger('place',false)->unsigned();
            $table->foreign('place')->references('id')->on('places')->onDelete( 'cascade' )->onUpdate( 'cascade' );
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
