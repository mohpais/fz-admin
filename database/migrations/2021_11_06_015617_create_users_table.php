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
            $table->unsignedBigInteger('corporate_id')->nullable();
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->string('marital')->nullable();
            $table->string('religion')->nullable();
            $table->string('pod')->nullable();
            $table->timestamp('bod')->nullable();
            $table->longText('address')->nullable();
            $table->boolean('open_work')->nullable()->default(false);
            $table->boolean('status')->nullable()->default(true);
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
