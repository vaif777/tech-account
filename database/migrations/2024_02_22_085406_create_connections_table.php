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
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->integer('distribution_id')->nullable();
            $table->string('network_equipment_id')->nullable();
            $table->integer('port')->nullable();
            $table->string('secondary_network_equipment_id')->nullable();
            $table->integer('secondary_port')->nullable();
            $table->integer('device_id')->nullable();
            $table->string('login')->nullable();
            $table->string('password')->nullable();
            $table->string('vlan')->nullable();
            $table->string('ip_address_network')->nullable();
            $table->string('ip_address_device')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
