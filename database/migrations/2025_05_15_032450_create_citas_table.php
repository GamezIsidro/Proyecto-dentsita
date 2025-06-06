<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
      Schema::create('citas', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('paciente_id');
    $table->unsignedBigInteger('slot_id');
    $table->string('motivo');
    // <-- aquí:
    $table->string('estado')->default('pendiente');
    $table->timestamps();

    // si no lo tienes aún, añade también la FK a users:
    $table->foreign('paciente_id')
          ->references('id')
          ->on('users')
          ->onDelete('cascade');
});

    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
