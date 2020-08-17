<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            // $table->collation = 'latin1_swedish_ci';
            $table->id();
            $table->foreignId('r_id')->constrained('rooms');
            $table->foreignId('u_id')->constrained('users');
            $table->date('tanggal_pinjam');
            $table->time('waktu_mulai',0);
            $table->time('waktu_selesai',0);
            $table->text('keperluan');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
