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
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('school_target', 10);
            $table->string('school_year', 20);
            $table->string('student_name');
            $table->string('gender', 10);
            $table->date('date_of_birth');
            $table->string('parent_guardian_name');
            $table->string('parent_guardian_phone', 30);
            $table->text('home_address');
            $table->string('status', 20)->default('pending')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registrations');
    }
};
