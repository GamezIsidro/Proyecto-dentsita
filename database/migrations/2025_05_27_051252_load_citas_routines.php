<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class LoadCitasRoutines extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Carga el SQL de tus SP, funciones y triggers sin ningún DELIMITER
        $sql = file_get_contents(database_path('sql/citas_routines.sql'));
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Elimina todo lo que creaste en up()
        DB::unprepared("
            DROP PROCEDURE IF EXISTS RegistrarUsuario;
            DROP PROCEDURE IF EXISTS AgendarCita;
            DROP PROCEDURE IF EXISTS CancelarCita;
            DROP PROCEDURE IF EXISTS VerCitasPorPaciente;
            DROP PROCEDURE IF EXISTS EliminarCita;
            DROP FUNCTION IF EXISTS CalcularEdad;
            DROP FUNCTION IF EXISTS ContarCitasPorPaciente;
            DROP FUNCTION IF EXISTS CitaOcupada;
            DROP FUNCTION IF EXISTS ExisteCitaPorSlot;
            DROP TRIGGER IF EXISTS Trg_PrevenirDobleCita;
            DROP TRIGGER IF EXISTS Trg_MarcarSlotNoDisp;
            DROP TRIGGER IF EXISTS Trg_LiberarSlot;
        ");
    }
}
