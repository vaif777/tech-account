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
        Schema::create('patch_panels', function (Blueprint $table) {
            $table->id(); 
            $table->integer('building_id');
            $table->integer('telecommunication_cabinet_id')->nullable();
            $table->integer('manufacturer_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('count_port');
            $table->integer('unit');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patch_panels');
    }
};
