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
        Schema::create('reference_network_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('device_type')->nullable();
            $table->string('parameter')->nullable();
            $table->integer('count_port')->nullable();
            $table->integer('unit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_equipment');
    }
};
