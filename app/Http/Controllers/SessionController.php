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
        if(Auth::guest()){
            return redirect('home');
        }
        $session = Session::find($id);
        $questions = DB::table('questions')
        ->where('questions.session_id', '=', $id)
        ->select('questions.id','questions.title', 'questions.content', 'questions.updated_at', 'users.name', DB::raw('count(answers.id) as ans_count'))
        ->join('users', 'users.id','=','questions.user_id')
        ->orderBy('questions.updated_at', 'desc')
        ->leftJoin('answers', 'answers.question_id','=','questions.id')
        ->groupBy('questions.id')
        ->get();
        return view('qna.question', [
            'questions' => $questions,
            'session' => $session
        ]);
    }
    public function create(Request $request, int $session_id) {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $user_id = Auth::user()->id;
        $question = new Question;
        $question->title = $request->title;
        $question->content = $request->content;
        $question->session_id = $session_id;
        $question->user_id = $user_id;
        $question->type = "text";
        $question->created_at = $now;
        $question->updated_at = $now;
        $question->save();
        return redirect()->route('showQuestion', ['id' => $session_id]);
    }
    public function edit(Request $request, int $session_id) {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $question = Question::find($request->e_id);
        $question->title = $request->name;
        $question->content = $request->noidung;
        $question->updated_at = $now;
        $question->save();
        return redirect()->route('showQuestion', ['id' => $session_id]);
    }
    public function delete(Request $request, int $session_id) {
        $question = new Question;
        $question->findOrFail($request->id)->delete();
        return redirect()->route('showQuestion', ['id' => $session_id]);
    }
}
