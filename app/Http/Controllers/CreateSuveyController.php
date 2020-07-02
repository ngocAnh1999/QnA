<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Session;
use App\Question;
use App\Answer;
use App\User;

class CreateSuveyController extends Controller
{
    //
    public function show(int $id) {
        $session = Session::find($id);
        $questions = $session->questions;
        $answers = DB::table('answers')
        ->select('answers.id','answers.content','answers.status', 'answers.question_id')
        ->where('questions.session_id','=',$id)
        ->join('questions','questions.id','=', 'answers.question_id')
        ->get();

        return view('survey.createSurvey',[
            'session'=>$session,
            'questions'=>$questions,
            'answers'=> $answers
        ]);
    }
    public function saveQuestion(Request $request, int $id_session) {
        $question = new Question;
        $question->content = $request->q_content;
        $question->type = $request->type;
        $question->session_id = $id_session;
        $question->user_id = Auth::user()->id;
        $question->title = "";
        $question->save();
        if($question->type == "multi" || $question->type == "one-ans") {
            $numbers = $request->num;
            if(isset($request->ans)) {
                for($i = 0; $i < count($request->ans); $i++) {
                    $answer = new Answer;
                    $answer->content = $request->ans[$i];
                    $answer->question_id = $question->id;
                    $answer->status = 0;
                    $answer->save();
                }
            }      
        }
        else if($request->type == "star-ans") {
            if(isset($request->total_star) && is_numeric($request->total_star)) {
                for($i = 1; $i <= $request->total_star; $i++) {
                    $answer = new Answer;
                    $answer->content = $i;
                    $answer->question_id = $question->id;
                    if($i == $request->total_star) {
                        $answer->status = 1;
                    }
                    else {
                        $answer->status = 0;
                    }
                    $answer->save();
                }
            }
        }

        return \redirect()->route('newSurvey', ['id'=> $id_session]);
    }
    
}
