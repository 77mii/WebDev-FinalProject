<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_projects', function (Blueprint $table) {
            $table->id();
            $table->string('sptitle'); // Title of the submission
            $table->text('sp_description')->nullable(); // Description
            $table->string('file_type');
            $table->foreignId('project_id')->constrained('projects');
            $table->boolean('visibility')->default(true); // New visibility column (true = visible, false = not visible)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_projects');
    }
};
