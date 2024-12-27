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
        Schema::create('academic_store_models', function (Blueprint $table) {
            $table->id();
            $table->string(" X Board");
            $table->year('X year');
            $table->string('X State');
            $table->string('X Marks');
            $table->string(" XI Board");
            $table->year('XI year');
            $table->string('XI State');
            $table->string('XI Marks');
            $table->string(" XII Board");
            $table->year('XII year');
            $table->string('XII State');
            $table->string('XII Marks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_store_models');
    }
};
