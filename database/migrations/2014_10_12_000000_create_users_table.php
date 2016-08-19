<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedInteger('sign_in_count')->default(0);
            $table->timestamp('current_sign_in_at')->nullable()->index();
            $table->timestamp('last_sign_in_at')->nullable();
            $table->string('current_sign_in_ip')->nullable();
            $table->string('last_sign_in_ip')->nullable();
            $table->unsignedInteger('failed_attempts')->default(0);

            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
