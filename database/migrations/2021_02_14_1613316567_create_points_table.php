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
		    $table->float('lon')->nullable();
		    $table->float('lat')->nullable();
		    $table->float('elevation')->nullable();
		    $table->float('temp')->nullable();
		    $table->float('temp_min')->nullable();
		    $table->float('temp_max')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('points');
    }
}
