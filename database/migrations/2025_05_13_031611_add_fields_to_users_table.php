<?php
// filepath: /home/isidro/Dentista_proyect/database/migrations/xxxx_xx_xx_xxxxxx_add_fields_to_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('fecha_nac')->nullable(); 
            $table->string('telefono')->nullable(); 
            $table->text('enfermedades')->nullable(); 
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['fecha_nac', 'telefono', 'enfermedades']);
        });
    }
};