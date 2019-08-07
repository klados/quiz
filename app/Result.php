<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

	protected $fillable = [
			'user_email', 'target_quiz', 'score',
	];
}
