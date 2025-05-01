<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('contratos', function (Blueprint $table) {
        $table->unsignedBigInteger('ocupante_id');  
        $table->unsignedBigInteger('responsable_id');  
        

        $table->foreign('ocupante_id')->references('id')->on('ocupantes')->onDelete('set null');
        $table->foreign('responsable_id')->references('id')->on('responsables')->onDelete('set null');
    });
}

};
