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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('category')->nullable();
            $table->string('university')->nullable();
            $table->mediumText('images')->nullable();
            $table->string('address')->nullable();
            $table->integer('price')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
