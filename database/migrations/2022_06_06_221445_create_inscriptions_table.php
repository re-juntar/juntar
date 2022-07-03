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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('set null');
            $table->tinyInteger('status');
            $table->date('pre_inscription_date')->nullable();
            $table->date('inscription_date')->nullable();
            $table->tinyInteger('accreditation');
            $table->string('certification', 200)->nullable();
            $table->timestamps();

            // $table->foreign('users_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('events_id')->references('id')->on('events')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscriptions');
    }
};
