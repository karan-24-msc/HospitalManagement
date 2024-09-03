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
        Schema::create('patient_investigations', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->text('hematology')->nullable();
            $table->text('biochemistry')->nullable();
            $table->text('stool')->nullable();
            $table->text('urine')->nullable();
            $table->text('serology')->nullable();
            $table->text('immunology')->nullable();
            $table->text('blood_bank')->nullable();
            $table->text('histopathology_cytology')->nullable();
            $table->text('semen_analysis_fluid')->nullable();
            $table->text('microbiology')->nullable();
            $table->text('ultra_snow_gram')->nullable();
            $table->text('x_ray')->nullable();
            $table->text('ecg')->nullable();
            $table->text('eco_ett')->nullable();
            $table->text('c_t_scan')->nullable();
            $table->text('others')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_investigations');
    }
};
