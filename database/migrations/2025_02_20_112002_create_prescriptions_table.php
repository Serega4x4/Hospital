<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->text('medication');
            $table->text('dosage');
            $table->text('instructions')->nullable();
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctors_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
