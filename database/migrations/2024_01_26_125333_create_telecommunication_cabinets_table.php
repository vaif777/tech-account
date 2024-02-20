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
        Schema::create('telecommunication_cabinets', function (Blueprint $table) {
            $table->id();
            $table->integer('storeroom_accounting_id')->nullable();
            $table->integer('manufacturer_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('depth')->nullable();
            $table->integer('unit')->nullable();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telecommunication_cabinets');
    }
};
