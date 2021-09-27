<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypeHasRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type_has_role', function (Blueprint $table) {
            $table->tinyInteger('type_id', unsigned: true);
            $table->tinyInteger('role_id', unsigned: true);

            # Foreign keys

            $table->foreign('type_id')
                ->references('id')
                ->on('user_types');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_type_has_role');
    }
}
