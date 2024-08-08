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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id')->nullable();
            $table->string('batch')->nullable();
            $table->string('page')->nullable();
            $table->text('url')->nullable(); 
            $table->text('issue_link')->nullable(); 
            $table->text('description')->nullable();
            $table->string('criterion')->nullable();
            $table->text('issue_reference')->nullable();
            $table->string('element')->nullable();
            $table->string('check_type')->nullable();
            $table->string('responsibility')->nullable();
            $table->string('severity')->nullable();
            $table->string('complexity')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->timestamp('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
