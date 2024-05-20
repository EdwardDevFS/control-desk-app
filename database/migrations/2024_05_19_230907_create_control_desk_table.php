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
        Schema::create('control_desk', function (Blueprint $table) {
            $table->id();
            $table->string('glp', 16)->unique();
            $table->string('plu', 16)->nullable();
            $table->integer('pso')->nullable()->check('PSO BETWEEN 300 AND 315 OR PSO BETWEEN 400 AND 415 OR PSO BETWEEN 500 AND 505');
            $table->integer('pre')->unique()->check('PRE BETWEEN 100 AND 999999');
            $table->char('dep', 2)->default('LM');
            $table->char('pis', 3)->default('PER');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_desk');
    }
};
