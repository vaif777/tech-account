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
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->integer('patch_panel_id')->nullable();
            $table->integer('patch_panel_port')->nullable();
            $table->integer('final_patch_panel_id')->nullable();
            $table->integer('final_patch_panel_port')->nullable();
            $table->integer('final_patch_panel_port')->nullable(); 
            $table->integer('patch_cord_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
