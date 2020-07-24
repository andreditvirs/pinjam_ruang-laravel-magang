<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            // $table->collation = 'latin1_swedish_ci';
            $table->id();
            $table->string('nama', 50);
            $table->string('lantai', 1);
            $table->integer('kapasitas');
            $table->text('fasilitas');
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');   
    }
}
