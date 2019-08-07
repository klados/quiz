<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
						$table->string('score');
            $table->timestamps();
						$table->string('user_email');
						$table->foreign('user_email')->references('email')->on('users')
									->onDelete('cascade');
						$table->bigInteger('target_quiz')->unsigned();
						$table->foreign('target_quiz')->references('id')->on('quizzes')
									->onDelete('cascade');
						$table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
