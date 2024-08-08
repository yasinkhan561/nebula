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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('website_id');
            $table->string('batch'); // Assuming 'batch' is a string
            $table->string('url'); // URL, hence string type
            $table->integer('nodes')->default(0); // Assuming an integer count
            $table->integer('critical')->default(0); // Assuming an integer count
            $table->integer('serious')->default(0); // Assuming an integer count
            $table->integer('moderate')->default(0); // Assuming an integer count
            $table->integer('minor')->default(0); // Assuming an integer count
            $table->decimal('score', 5, 2)->nullable(); // Assuming a decimal score, nullable
            $table->integer('aria')->default(0); // Count for aria category
            $table->integer('forms')->default(0); // Count for forms category
            $table->integer('name_role_value')->default(0);
            $table->timestamp('scan_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
