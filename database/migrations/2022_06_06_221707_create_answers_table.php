<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('inscription_id')->nullable()->constrained()->onDelete('set null');
            $table->longText('description');
            $table->timestamps();

            // $table->foreign('questions_id')->references('id')->on('questions')->onDelete('set null');
            // $table->foreign('inscriptions_id')->references('id')->on('inscriptions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
