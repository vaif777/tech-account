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
        Schema::create('reference_network_equipment_ports', function (Blueprint $table) {
            $table->id();
            $table->integer('reference_network_equipment_id');
            $table->integer('from');
            $table->integer('before')->nullable();
            $table->string('bandwidth')->nullable();
            $table->string('connection_interfaces')->nullable();
            $table->string('port_functionality')->nullable();
            $table->string('network_architecture_port')->nullable();
            $table->string('power')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patch_panel_ports');
    }
};
