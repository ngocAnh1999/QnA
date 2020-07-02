<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Session;
use App\Question;
use App\User;

class StatisticController extends Controller
{
    public function show() {
        $user = Auth::user();
        if($user->hasRole('admin')) {
            $sessions = DB::table('sessions')
                        ->select('sessions.id','sessions.name','sessions.mota','sessions.updated_at','sessions.required',Db::raw('count(questions.id) as sum_q'))
                        ->join('questions','questions.session_id','=','sessions.id')
                        ->whereRaw("sessions.type_id = 2 and sessions.user_id = $user->id")
                        ->groupBy("sessions.id")
                        ->orderBy('sessions.updated_at', 'desc')
                        ->get();
            return view('survey.statistic',
                ['sessions'=>$sessions]
            );
        }
    }
    public function index(int $id) {
        $session = Session::find($id);
        $questions = $session->questions;
        $answers = DB::table('answers')
        ->select('answers.id','answers.content','answers.status', 'answers.question_id',DB::raw('COALESCE(count(answer_user.user_id)) as sum_user'))
        ->where('questions.session_id','=',$id)
        ->join('questions','questions.id','=', 'answers.question_id')
        ->leftJoin('answer_user', 'answer_user.answer_id','=','answers.id')
        ->groupBy('answers.id')
        ->get();
        return view('survey.indexStatistic',[
            'session' => $session,
            'questions'=>$questions,
            'answers'=>$answers
        ]);
    }
}
