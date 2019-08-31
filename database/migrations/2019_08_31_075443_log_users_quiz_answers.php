<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogUsersQuizAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->bigIncrements('id');

						$table->string('question')->nullable();
						$table->string('answer')->nullable();
						$table->string('correct_answer')->nullable();

						$table->bigInteger('quiz_id')->unsigned();
						$table->foreign('quiz_id')->references('id')->on('quizzes')
									->onDelete('cascade');

						$table->bigInteger('result_id')->unsigned();
						$table->foreign('result_id')->references('id')->on('results')
									->onDelete('cascade');

						$table->engine = 'InnoDB';
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
        Schema::table('quiz_answers', function (Blueprint $table) {
            //
        });
    }
}
