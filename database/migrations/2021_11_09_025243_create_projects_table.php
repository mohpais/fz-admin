<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('corporate_id')->nullable();
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->nullable()->default(false);
            $table->string('thumbnail', 255)->nullable();
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
        Schema::dropIfExists('projects');
    }
}
