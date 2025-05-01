<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ocupantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nicho_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('dpi')->nullable();
            $table->string('procedencia');
            $table->date('fecha_fallecimiento');
            $table->string('causa_muerte')->nullable();
            $table->enum('genero', ['masculino', 'femenino']);
            $table->date('fecha_contrato');
            $table->date('fecha_finalizacion');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocupantes');
    }
};
