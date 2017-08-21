<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\QuestionnaireModel;
use App\ScoreModel;
use App\CommentModel;
use Charts;
use App\StoreScoreModel;
use App\StoreCommentModel;
use App\UserStatusModel;

class MakeQuestionnaireController extends Controller
{
    public function assessment($id)
    {
      $auth = Auth::user();
      $user = User::find($id);
      $questionnaire = QuestionnaireModel::all();
      $scores = ScoreModel::where('auth_id', $auth->id)->where('user_id', $user->id)->get();

      if ($scores->isEmpty()) {

        return view('assessment.form', ['auth' => $auth, 'user' => $user, 'questionnaire' => $questionnaire]);

      }else {

      flash()->error( 'You have already evaluated this employee.');
      return redirect("/user");
      
    }

    }

    public function doassessment(Request $request, $id)
    {
      $auth = Auth::id();

      for ($i=0; $i < count($request->questionnaire_id); $i++) {
        // $score = new ScoreModel();
        $score = new ScoreModel();
        $score->auth_id = $request->auth_id;
        $score->user_id = $request->user_id;
        $score->questionnaire_id = $request->questionnaire_id[$i];
        $score->score = $request->score[$i];
        $score->save();
      }
        $comment = new CommentModel();
        $comment->auth_id = $request->auth_id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $comment->save();


          return redirect("/user");
        }

        public function totalScore( $id)
        {
          $user_id = Auth::id();
          $questionnaires = QuestionnaireModel::with('scores')->whereHas('scores', function ($query) use ($user_id) {
                                              $query->where('user_id', $user_id);
                                            })->get();

          // dd($questionnaires->first()->user_scores($user_id)->sum());
          $auth = Auth::user();
          $score = ScoreModel::where('score.user_id', '=', $auth->id)->get();
          $comment = CommentModel::where('comment.user_id', '=', $auth->id)->get();
          $questionnaire = QuestionnaireModel::all();

          return view('assessment.result', ['auth' => $auth, 'score' =>$score, 'comment' =>$comment, 'questionnaires' => $questionnaires  ]);

        }

        public function resultTotlalScore($id)
        {
          $user = User::find($id);
          $questionnaires = QuestionnaireModel::with('scores')->whereHas('scores', function ($query) use ($id) {
                                              $query->where('user_id', $id);
                                            })->get();

          // dd($questionnaires->first()->user_scores($user)->sum());
          // $auth = Auth::user();
          $score = ScoreModel::where('score.user_id', '=', $id)->get();
          $comment = CommentModel::where('comment.user_id', '=', $id)->get();
          $questionnaire = QuestionnaireModel::all();

          return view('assessment.show_for_admin', ['user' => $user, 'score' =>$score, 'comment' =>$comment, 'questionnaires' => $questionnaires]);
        }
        public function storeResult(Request $request, $id)
        {

          for ($i=0; $i < count($request->question_id); $i++) {
            // $score = new ScoreModel();
            $data = new StoreScoreModel();
            $data->user_id = $request->user_id;
            $data->user_name = $request->user_name;
            $data->question = $request->question[$i];
            $data->sume_score = $request->sume_score[$i];
            $data->save();
          }

          for ($i=0; $i < count($request->comment); $i++) {
            // $score = new ScoreModel();
            $com = new StoreCommentModel();
            $com->user_id = $request->user_id;
            $com->user_name = $request->user_name;
            $com->comment = $request->comment[$i];
            $com->save();
          }

          return redirect("/user");
        }



}
