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
        Schema::create('endorsement_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedBigInteger('academic_unit_id')->nullable();
            $table->timestamp('request_date')->useCurrent();
            $table->string('request_token', 200)->nullable();
            $table->timestamp('revision_date')->nullable();
            $table->tinyInteger('endorsed')->nullable(); //Avalado 1 o 0
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();

            $table->foreign('academic_unit_id')->references('id')->on('academic_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endorsement_requests');
    }
};

