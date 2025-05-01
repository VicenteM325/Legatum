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
        Schema::table('nichos', function (Blueprint $table) {
            $table->integer('calle')->change();
            $table->integer('avenida')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nichos', function (Blueprint $table) {

            $table->string('calle')->change();
            $table->string('avenida')->change();
        });
    }
};
