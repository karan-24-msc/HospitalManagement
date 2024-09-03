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
            $table->id();
            $table->string('app_id');
            $table->string('app_name');
            $table->string('app_email');
            $table->string('app_phone');
            $table->string('app_age');
            $table->string('app_gender');
            $table->string('department');
            $table->string('doctor');
            $table->string('app_date');
            $table->string('notes')->nullable();
            $table->integer('patient_status')->default(0);
            $table->string('app_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_appointments');
    }
};
