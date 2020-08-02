<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            // $table->collation = 'latin1_swedish_ci';
            $table->id();
            $table->string('nip', 18)->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama', 50);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('jabatan_id')->constrained('position_in_departments');
            $table->unsignedBigInteger('department_id');
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
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign('admins_jabatan_id_foreign');
        });
        Schema::dropIfExists('admins');
    }
}
