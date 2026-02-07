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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('platform')->nullable();
            $table->integer('rating')->nullable();
            $table->text('review')->nullable();
            $table->integer('price')->nullable();
            $table->string('condition')->nullable();
            $table->string('status')->default('unplayed');
            $table->integer('play_time_minutes')->nullable();
            $table->date('purchased_at')->nullable();
            $table->date('cleared_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
