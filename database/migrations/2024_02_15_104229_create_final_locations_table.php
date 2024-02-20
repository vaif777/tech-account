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
        Schema::create('final_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('final_building_id');
            $table->integer('final_floor_id')->nullable();
            $table->integer('final_room_id')->nullable();
            $table->integer('final_telecommunication_cabinet_id')->nullable();
            $table->unsignedBigInteger('locatable_id');
            $table->string('locatable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_locations');
    }
};
