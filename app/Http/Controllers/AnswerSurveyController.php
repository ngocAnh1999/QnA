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

class AnswerSurveyController extends Controller
{
    //
    public function answer(Request $request) {
        $session = Session::find($request->session_id);
        if($session != null){
            if($session->required == trim($request->required) || $session->required == null || $session->required =="") {
                $questions = $session->questions;
                $answers = DB::table('answers')
                ->select('answers.id','answers.content','answers.status', 'answers.question_id')
                ->where('questions.session_id','=',$request->session_id)
                ->join('questions','questions.id','=', 'answers.question_id')
                ->get();
        
                return view('survey.answerSurvey',[
                    'session'=>$session,
                    'questions'=>$questions,
                    'answers'=> $answers
                ]);
            }
        }
        return redirect()->back();
    }
    public function submitAnswer(Request $request) {
        // dd($request->all());
        $user = Auth::user();
        if($request->answer != null) {

            for($i = 0; $i < count($request->answer); $i++) {
                $answer = Answer::find($request->answer[$i]);
                if($answer != null) {
                    
                    $answer->pickedByUsers()->toggle($user);
                }
            }
        }
        if($request->star != null) {
            for($i = 0; $i < count($request->star); $i+=2) {
                $question = Question::find($request->star[$i]);
                $answer = $question->answers->where('content',$request->star[$i+1])->first();
                if($answer != null) {
                    $answer->pickedByUsers()->toggle($user);
                }
                
            }
        }
        if($request->text != null) {
            for($i = 0; $i < count($request->text); $i+=2) {
                $question = Question::find($request->text[$i]);
                if($request->text[$i+1] != "" && $request->text[$i+1] != null) {

                    $answer = new Answer;
                    $answer->content = $request->text[$i+1];
                    $answer->question_id = $question->id;
                    $answer->status = 0; 
                    $answer->save();
                    
                    $answer->pickedByUsers()->toggle($user);
                }
            }
        }
        return \redirect()->route('survey',['select'=>'all']);
    }
}
