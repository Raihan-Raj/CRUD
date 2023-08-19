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
        Schema::create('book_borrowers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('register_user_id');
            $table->uuid('book_id');
            $table->dateTime('assign_date');
            $table->dateTime('return_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('register_user_id')->references('id')->on('register_users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('book_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_borrowers');
    }
};
