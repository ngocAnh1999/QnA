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
class QuestionController extends Controller
{
    //
    public function show(int $id) {
        if(Auth::guest()){
            return redirect('home');
        }
        $question = Question::find($id);
        $session = $question->session;
        $q_user = $question->user;
        $answers = DB::table('answers')
        ->where('answers.question_id', '=', $id)
        ->select('answers.id','answers.content', 'answers.status', 'answers.updated_at', 'users.name')
        ->join('answer_user', 'answers.id', '=', 'answer_user.answer_id')
        ->join('users', 'answer_user.user_id','=','users.id')
        ->orderBy('answers.status', 'desc')
        ->get();
        return view('qna.insertAnswer',[
            'answers'=> $answers,
            'session' => $session,
            'question' => $question,
            'q_user' => $q_user
        ]);
    }
    public function create(Request $request, int $id) {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $user = Auth::user();
        $question = Question::find($id);
        $session = $question->session;
        $answer = new Answer;
        $answer->content = $request->noidung;
        $answer->question_id = $id;
        if($user->id == $session->user_id) {
            $answer->status = 1;
        }
        else {
            $answer->status = 0;
        }
        $answer->created_at = $now;
        $answer->updated_at = $now;
        $answer->save();
        $answer->pickedByUsers()->toggle($user);
        return redirect()->route('ansQuestion',['id' => $id]);
    }
    public function edit(Request $request, int $id) {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $answer = Answer::find($request->e_id);
        $answer->content = $request->noidung;
        $answer->updated_at = $now;
        $answer->save();

        return redirect()->route('ansQuestion',['id' => $id]);
    }
    public function delete(Request $request, int $id) {
        $answer = new Answer;
        $answer->findOrFail($request->del_id)
                ->pickedByUsers()
                ->toggle($answer->pickedByUsers);
        $answer->findOrFail($request->del_id)->delete();

        return redirect()->route('ansQuestion',['id' => $id]);
    }

    public function accept(int $id) {
        $answer = Answer::find($id);
        $question = $answer->question;
        $answer->status = 1;
        $answer->save();
        return redirect()->route('ansQuestion',['id' => $question->id]);
    }
    public function deaccept(int $id) {
        $answer = Answer::find($id);
        $question = $answer->question;
        $answer->status = 0;
        $answer->save();
        return redirect()->route('ansQuestion',['id' => $question->id]);
    }
}

