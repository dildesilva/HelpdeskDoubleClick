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
        Schema::create('tiket_user_m_o_d_s', function (Blueprint $table) {
            $table->id();
                    $table->string('subject');
                    $table->string('email');
                    $table->string('company');
                    $table->string('branch')->nullable();
                    $table->text('description');
                    $table->text('Assigned')->default('Waiting');
                    $table->timestamps();
                    $table->string('sender');
                    $table->primary(['id','sender']);
                    $table->foreign('email')->references('email')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_user_m_o_d_s');
    }
};
