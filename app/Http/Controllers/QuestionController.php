<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Session;
use App\Question;
use App\Answer;
class QuestionController extends Controller
{
    //
    public function show(int $id) {
        $question = Question::find($id);
        $session = $question->session;
        $answers = DB::table('answers')
        ->where('answers.question_id', '=', $id)
        ->select('')
        ->join('questions', 'questions.id', '=', 'answers.question_id')
        ->join('answer_user', 'answer.id', '=', 'answer_user.answere_id')
        ->join('users', 'answer_user.user_id','=','users.id');
        return view('qna.insertAnswer',[
            'answers'=> $answers,
            'session' => $session,
            'question' => $question
        ]);
    }
}

