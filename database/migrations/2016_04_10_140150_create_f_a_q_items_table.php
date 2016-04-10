<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFAQItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_a_q_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('anwser');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('f_a_q_categories')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('f_a_q_items');
    }
}
