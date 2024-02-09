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
        Schema::create('temporary_data_for_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->boolean('add')->default(false);
            $table->boolean('edit')->default(false);
            $table->boolean('delite')->default(false);
            $table->boolean('activated')->default(false);
            $table->boolean('to_activate')->default(false);
            $table->boolean('network_infrastructure')->default(false);
            $table->boolean('telephone_infrastructure')->default(false);
            $table->boolean('storage')->default(false);
            $table->boolean('common_elements')->default(false);
            $table->boolean('user')->default(false);
            $table->boolean('setting')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_data_for_registrations');
    }
};
