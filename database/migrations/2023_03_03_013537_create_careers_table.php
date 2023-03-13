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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('description')->nullable();
            $table->string('requirements')->nullable();
            $table->string('posisi');
            $table->string('unit');
            $table->unsignedBigInteger('information_id');
            $table->foreign('information_id')->references('id')->on('informations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career');
    }
};
