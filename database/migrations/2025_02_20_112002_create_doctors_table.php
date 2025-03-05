<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('speciality');
            $table->integer('appointment_duration')->default(15);
            $table->timestamps();

            $table->softDeletes();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
