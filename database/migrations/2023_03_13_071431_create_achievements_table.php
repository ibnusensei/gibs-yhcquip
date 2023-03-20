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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('achiev');
            $table->string('title');
            $table->string('slug');
            $table->string('location');
            $table->year('year');
            $table->foreignId('level_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::table('gainers', function (Blueprint $table) {
            $table->foreignId('achievement_id')->default(1)->after('from')->constrained('achievements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
