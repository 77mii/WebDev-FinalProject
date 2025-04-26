<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('projectname');
            $table->text('description');
            $table->string('status');
            $table->string('type');
            $table->string('projectimage')->nullable();
            $table->foreignId('lmk_id')->constrained('lecturer_mks');
            $table->boolean('visibility')->default(true); // New visibility column
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
