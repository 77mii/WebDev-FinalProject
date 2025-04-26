<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturer_mks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->constrained('lecturers');
            $table->foreignId('mk_id')->constrained('mata_kuliahs');
            $table->string('tahun');
            $table->string('semester');
            $table->string('lmk_status')->default('Ongoing'); // New status: Ongoing/Finished
            $table->string('additional_lecturers')->nullable();
            $table->string('lmk_image')->nullable();  // Add a nullable image column
            $table->boolean('visibility')->default(true); // New visibility column
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturer_mks');
    }
};
