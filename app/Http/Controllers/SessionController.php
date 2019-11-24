<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Session;

class SessionController extends Controller
{
    public function show(int $id) {
        $questions = DB::table('questions')
        ->where('questions.session_id', '=', $id)
        ->select('questions.title', 'questions.content', 'questions.updated_at', 'users.name')
        ->join('users', 'users.id','=','questions.user_id')
        ->orderBy('questions.updated_at', 'desc')
        ->get();
        return view('qna.question', [
            'questions' => $questions
        ]);
    }
    public function create(Request $request) {
        
    }
    public function edit(Request $request) {
        
    }
    public function delete(Request $request) {
        
    }
}
