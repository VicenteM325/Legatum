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
        Schema::create('exhumaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nicho_id')->constrained();
            $table->string('solicitante');
            $table->text('motivo');
            $table->boolean('aprobado')->default(false);
            $table->foreignId('nuevo_ocupante_id')->nullable()->constrained('ocupantes');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhumaciones');
    }
};
