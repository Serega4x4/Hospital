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
        Schema::create('opening_hours', function (Blueprint $table) {
            $table->id();
            $table->json('hours');
            $table->timestamps();

            $table->softDeletes();

            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opening_hours');
    }
};
