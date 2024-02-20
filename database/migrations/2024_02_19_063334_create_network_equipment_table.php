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
        Schema::create('network_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('manufacturer_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('storeroom_accounting_id')->nullable();
            $table->integer('IP_address')->nullable();
            $table->integer('MAC_address')->nullable();
            $table->integer('count_port');
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
