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
        Schema::create('academic_unit_users', function (Blueprint $table) {
            // This table needs to have an extra 'id' column equal to 'user_id'
            //   to fix problem when closing and re-opening the 'AddUserAcademicUnitModal'
            //   modal,
            // For some reason, the function:
            //   ~> AcademicUnitUser::all()->where('user_id', $this->user->id);
            //   fails when re-opening the modal, laravel replaces 'user_id' by 'id'
            //   and fails since 'id' didn't existed in this table, hence the redundancy.
            $table->foreignId('id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('academic_unit_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_unit_users');
    }
};
