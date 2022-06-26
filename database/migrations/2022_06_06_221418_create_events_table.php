<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('event_category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('event_status_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('event_modality_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name', 200);
            $table->string('short_name', 100);
            $table->longText('description');
            $table->string('venue', 200)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('endorsed')->default('0');
            $table->string('token', 255)->default('0');
            $table->string('image_flyer', 200)->nullable(); //OBS: ver como es la carga de las imagenes y como funcionan flyer y logo
            $table->string('image_logo', 200)->nullable();
            $table->integer('capacity')->nullable();
            $table->tinyInteger('pre_registration');
            $table->string('meeting_link')->nullable();
            $table->date('inscription_end_date')->nullable();
            $table->string('accreditation_token', 100);
            $table->timestamps();

            // $table->foreign('users_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('event_categories_id')->references('id')->on('event_categories')->onDelete('set null');
            // $table->foreign('event_statuses_id')->references('id')->on('event_statuses')->onDelete('set null');
            // $table->foreign('event_modalities_id')->references('id')->on('event_modalities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
