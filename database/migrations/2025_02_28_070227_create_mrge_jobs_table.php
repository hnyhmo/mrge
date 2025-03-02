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
        Schema::create('mrge_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('external_id')->nullable();
            $table->string('email')->nullable();
            $table->string('office')->nullable();
            $table->string('department')->nullable();
            $table->string('recruitingCategory')->nullable();
            $table->string('subcompany')->nullable();
            $table->string('employmentType')->nullable();
            $table->string('seniority')->nullable();
            $table->string('schedule')->nullable();
            $table->string('yearsOfExperience')->nullable();
            $table->text('keywords')->nullable();
            $table->string('occupation')->nullable();
            $table->string('occupationCategory')->nullable();
            $table->string('createdAt')->timestamps();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrge_jobs');
    }
};
