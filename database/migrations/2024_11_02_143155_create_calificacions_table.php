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
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reseña_id');
                $table->foreign('reseña_id')
                ->references('id')
                ->on('reseñas')
                ->onDelete('cascade');
            $table->integer('time');
            $table->integer('quality');
            $table->integer('communication');
            $table->integer('price');
            $table->decimal('final');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificacions');
    }
};
