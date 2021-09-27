<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->char('password', 64);
            $table->tinyInteger('type_id', unsigned: true);
            $table->tinyInteger('status_id', unsigned: true);
            $table->bigInteger('profile_photo_id', unsigned: true)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable();

            # Foreign keys

            $table->foreign('type_id')
                ->references('id')
                ->on('user_types');

            $table->foreign('status_id')
                ->references('id')
                ->on('user_statuses');

            $table->foreign('profile_photo_id')
                ->references('id')
                ->on('profile_photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
