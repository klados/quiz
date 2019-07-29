<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quizzes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // Schema::dropIfExists('quizzes');
			Schema::create('quizzes', function (Blueprint $table) {
					$table->bigIncrements('id');
					$table->string('quizName');
					$table->string('description');
					$table->string('ownerEmail');
					// $table->string('password');
					// $table->rememberToken();
					$table->enum('access', ['public', 'invitation'])->default('public');
					$table->timestamps();
					$table->foreign('ownerEmail')->references('email')->on('users');
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
