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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->integer('materials_references_id');
            $table->integer('manufacturer_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('depth')->nullable();
            $table->integer('length')->nullable();
            $table->integer('diameter')->nullable();
            $table->boolean('total_length')->default(false);
            $table->integer('count_ports')->nullable(); 
            $table->integer('amount_in_package')->nullable();
            $table->integer('count_package')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
