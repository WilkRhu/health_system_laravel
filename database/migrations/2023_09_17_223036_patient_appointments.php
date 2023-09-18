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
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->uuid('id');
            $table->enum('private', [true, false])->default(true);
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExistis('patient_appointments');
    }
};
