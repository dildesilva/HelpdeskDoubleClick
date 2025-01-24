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
        Schema::create('tiket_admin_m_o_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('assigne');
            $table->string('sender');
            $table->string('company');
            $table->string('branch');
            $table->string('state')->default('start');
            $table->date(column: 'dateCreated')->nullable();
            $table->string('description')->nullable();
            $table->foreign('assigne')->references('email')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_admin_m_o_d_s');
    }
};
