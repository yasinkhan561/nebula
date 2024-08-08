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
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->integer('violation_id');
            $table->json('any')->nullable();
            $table->json('all')->nullable();
            $table->json('none')->nullable();
            $table->string('node_impact')->nullable();
            $table->text('html')->nullable();
            $table->json('target')->nullable();
            $table->text('failureSummary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
