<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorIdToSlotsTable extends Migration
{
    public function up()
    {
        Schema::table('slots', function (Blueprint $table) {
            // 1) Añade la columna doctor_id
            $table->unsignedBigInteger('doctor_id')
                  ->nullable()
                  ->after('id'); // o después de la columna que prefieras

            // 2) Define la foreign key
            $table->foreign('doctor_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('slots', function (Blueprint $table) {
            // 1) Suelta la clave foránea
            $table->dropForeign(['doctor_id']);
            // 2) Suelta la columna
            $table->dropColumn('doctor_id');
        });
    }
}
