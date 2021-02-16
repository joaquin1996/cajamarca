<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {

            $table->bigIncrements('id');
		    $table->text('name');
		    $table->text('description')->nullable();
		    $table->decimal('lon', 35,30)->nullable();
		    $table->decimal('lat', 35,30)->nullable();
		    $table->decimal('elevation', 10,2)->nullable();
		    $table->decimal('temp', 5,2)->nullable();
		    $table->decimal('temp_min', 5,2)->nullable();
		    $table->decimal('temp_max', 5,2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('points');
    }
}
