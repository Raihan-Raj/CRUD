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
        Schema::create('book_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('author_id');
            $table->uuid('category_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('book_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_lists');
    }
};
