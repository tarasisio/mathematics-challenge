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
        Schema::disableForeignKeyConstraints();

        Schema::create('answers', function (Blueprint $table) {
            $table->id('answer_id');
            $table->bigInteger('question_id')->unsigned();
            $table->unsignedBigInteger('challenge_id');
            $table->integer('answer');
            $table->timestamps();

            // Ensure the questions table exists and the column is named correctly
            $table->foreign('question_id')->references('question_id')->on('questions')->onDelete('cascade');
            $table->foreign('challenge_id')->references('challenge_id')->on('challenges')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('answers');

        Schema::enableForeignKeyConstraints();
    }
};
