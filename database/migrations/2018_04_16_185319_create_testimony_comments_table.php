<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimony_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('testimony_id')->nullable()->unsigned();
            $table->foreign('testimony_id')->references('id')->on('testimonies');
            $table->text('comment');
            // $table->boolean('approved')->default(true);
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
        Schema::drop('testimony_comments');
    }
}
