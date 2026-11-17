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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Web Development');
            $table->string('instructor');
            $table->string('instructor_title')->nullable();
            $table->text('description');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->string('location')->default('Lab Komputer RPL');
            $table->unsignedInteger('price');
            $table->unsignedInteger('quota');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
