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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id');
            $table->integer('assigned_dep');
            $table->integer('assigned_doc');
            $table->string('registration_no');
            $table->string('name');
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('contact');
            $table->json('opt_contact')->nullable();
            $table->text('email')->nullable();
            $table->string('religion')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_bg')->nullable();
            $table->string('father_age')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_bg')->nullable();
            $table->string('mother_age')->nullable();
            $table->string('address')->nullable();
            $table->string('patient_type')->default(1);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
