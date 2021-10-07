<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalRecruiterDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_recruiter_data', function (Blueprint $table) {
            $table->bigInteger('user_id', unsigned: true);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('phone_number', 14)->nullable();
            $table->integer('city_id', unsigned: true);
            $table->timestamp('birthday')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->integer('nationality_id', unsigned: true)->nullable();
            $table->text('professional_courses')->nullable();

            # Foreign keys

            $table->foreign('user_id')
                ->onDelete('cascade')
                ->references('id')
                ->on('users');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities');

            $table->foreign('nationality_id')
                ->references('id')
                ->on('nationalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('physical_recruiter_data');
    }
}
