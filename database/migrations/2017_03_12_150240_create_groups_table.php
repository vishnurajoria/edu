<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('group_user', function (Blueprint $table) {
            $table->integer('group_id');
            $table->integer('user_id');
            $table->primary(['group_id', 'user_id']);
        });

        Schema::create('course_group', function (Blueprint $table) {
            $table->integer('course_id');
            $table->integer('group_id');
            $table->primary(['course_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_user');
        Schema::dropIfExists('course_group');
    }
}
