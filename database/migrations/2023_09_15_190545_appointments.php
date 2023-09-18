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
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id_medical');
            $table->uuid('user_id_patient');
            $table->uuid('procedures_id');
            $table->date('date');
            $table->time('hours');
            $table->enum('private', ['true', 'false'])->default('true');
            $table->timestamps();

            $table->foreign('user_id_medical')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('user_id_patient')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('procedures_id')
                ->references('id')
                ->on('procedures')
                ->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExistis('appointments');
    }
};
