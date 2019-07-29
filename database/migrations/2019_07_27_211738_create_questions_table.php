<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
						$table->string('question');
						$table->enum('type',['Text', 'Single Line', 'Radio buttons']);
						$table->string('correct_answer')->nullable();
						$table->json('options')->nullable();
						$table->bigInteger('target_quiz')->unsigned();
						$table->foreign('target_quiz')->references('id')->on('quizzes')
									->onDelete('cascade');
						$table->engine = 'InnoDB';
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
