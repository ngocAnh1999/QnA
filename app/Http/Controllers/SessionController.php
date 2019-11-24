<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Session;
use App\Question;
class SessionController extends Controller
{
    public function show(int $id) {
        $questions = DB::table('questions')
        ->where('questions.session_id', '=', $id)
        ->select('questions.title', 'questions.content', 'questions.updated_at', 'users.name', DB::raw('count(answers.id) as ans_count'))
        ->join('users', 'users.id','=','questions.user_id')
        ->orderBy('questions.updated_at', 'desc')
        ->leftJoin('answers', 'answers.question_id','=','questions.id')
        ->groupBy('questions.id')
        ->get();
        return view('qna.question', [
            'questions' => $questions,
            'session_id' =>$id
        ]);
    }
    public function create(Request $request, int $id) {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $user_id = Auth::user()->id;
        $question = new Question;
        $question->title = $request->title;
        $question->content = $request->content;
        $question->session_id = $id;
        $question->user_id = $user_id;
        $question->type = "text";
        $question->created_at = $now;
        $question->updated_at = $now;
        $question->save();
        return redirect()->route('showQuestion', ['id' => $id]);
    }
    public function edit(Request $request) {
        
    }
    public function delete(Request $request) {
        
    }
}
