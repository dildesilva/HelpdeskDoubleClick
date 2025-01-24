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
        Schema::create('tiket_eng_m_o_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->integer('AsingId')->nullable();
            $table->string('subject')->nullable();
            $table->string('sender')->nullable();
            $table->string('company')->nullable();
            $table->string('branch')->nullable();
            $table->string('state')->default('start');
            $table->string('TUpdate')->default('start');
            $table->date('opendate')->nullable();
            $table->date('Assinreddate')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_eng_m_o_d_s');
    }
};
