<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleryTable extends Migration
{
    public function up()
    {
        Schema::create('galery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('activity',false)->unsigned();
            $table->text('file')->nullable();
            $table->foreign('activity')->references('id')->on('activities')->onDelete( 'cascade' )->onUpdate( 'cascade' );
        });
    }

    public function down()
    {
        Schema::dropIfExists('galery');
    }
}
