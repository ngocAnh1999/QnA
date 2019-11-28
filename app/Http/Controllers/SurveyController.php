<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Session;
use App\Question;

class SurveyController extends Controller
{
    //
    public function index() {
        if(Auth::guest()){
            return redirect('home');
        }
        $user = Auth::user();
        $sesions = $user->sessions;
        return view('survey.index',[
            'sessions'=>$sesions
        ]);
    }
    
}
