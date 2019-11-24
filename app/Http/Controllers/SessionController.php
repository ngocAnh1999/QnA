<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Session;

class SessionController extends Controller
{
    //
    public function show(int $id) {
        $session = Session::find($id);
        $questions = $session->questions();
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
