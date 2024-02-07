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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('add')->default(false);
            $table->boolean('edit')->default(false);
            $table->boolean('delite')->default(false);
            $table->boolean('activated')->default(false);
            $table->boolean('SCS')->default(false);
            $table->boolean('telephony')->default(false);
            $table->boolean('storage')->default(false);
            $table->boolean('common_elements')->default(false);
            $table->boolean('users')->default(false);
            $table->boolean('settings')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
