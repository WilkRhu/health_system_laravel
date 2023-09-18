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
        Schema::create('appointments_procedure', function (Blueprint $table) {
            $table->uuid('procedures_id');
            $table->uuid('appointments_id');

            $table->foreign('procedures_id')
                ->references('id')
                ->on('procedures')
                ->onDelete('cascade');

            $table->foreign('appointments_id')
                ->references('id')
                ->on('appointments')
                ->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExistis('appointments_procedure');
    }
};
