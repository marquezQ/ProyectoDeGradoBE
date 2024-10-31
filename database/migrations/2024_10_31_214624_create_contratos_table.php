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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trabajador_id');
                $table->foreign('trabajador_id')->nullable()
                ->references('id')
                ->on('trabajadors')
                ->onDelete('set null'); //no eliminara contratos de trabajadores eliminados, por eso nulleable
            $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->json('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
