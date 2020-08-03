<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('body');
            $table->timestamps();

            /*
             * this is Polymorphic relationship
             * Comment to Comment is One To Many
             * Comment to Post    is One To Many
             * Post to Comment    is Many To One
             */
            $table->unsignedBigInteger('commentable_id');   // to store comment, post ID
            $table->string('commentable_type');     // to specification it's post or comment
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
