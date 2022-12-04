<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_roles',function(Blueprint $table)
        {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('role_id')->constrained();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_roles',function(Blueprint $table)
        {
          $table->dropForeign('user_id');
          $table->dropForeign('role_id');
        });
        Schema::dropIfExists('users_roles');
    }
}
