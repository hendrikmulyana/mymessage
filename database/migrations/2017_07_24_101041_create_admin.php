<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namadepan',10);
            $table->string('namabelakang',20);
            $table->string('gender',10);
            $table->string('slug');
            $table->string('email',30)->unique();
            $table->string('avatar')->default('default.png');
            $table->string('notelp',12);
            $table->string('username',10);
            $table->string('password',200);
            $table->rememberToken();
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
        Schema::dropIfExists('admin');
    }
}
