<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('done_enftikets', function (Blueprint $table) {
            $table->id();
            $table->integer('tokenNo')->nullable();
            $table->string('client')->nullable();
            $table->string('subject')->nullable();
            $table->string('State')->nullable();
            $table->string('TUpdate')->nullable();
            $table->string('email')->nullable();
            $table->integer('engid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('done_enftikets');
    }
};
