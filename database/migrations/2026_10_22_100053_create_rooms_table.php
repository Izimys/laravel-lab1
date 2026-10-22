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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 10)->unique(); // Номер кімнати
            $table->string('type', 50);                  // Категорія
            $table->integer('price');                    // Ціна
            $table->integer('capacity');                 // Місткість
            $table->boolean('is_available')->default(true); // Доступність
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
