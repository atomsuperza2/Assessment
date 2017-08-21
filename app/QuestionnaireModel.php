<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireModel extends Model
{
  protected $table = 'questionnaire';
  protected $guarded = [ ];

  public function scores() {
	   return $this->hasMany('App\ScoreModel', 'questionnaire_id', 'id');
  }

  public function user_scores($id) {
	   return $this->hasMany('App\ScoreModel', 'questionnaire_id', 'id')->where('user_id', $id)->get();
  }
}
