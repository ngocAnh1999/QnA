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
    public function index(string $select) {
        if(Auth::guest()){
            return redirect('home');
        }
        $me = $this;
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $session = null;
        switch($select) {
            case 'all': {
                $session = $me->all();
            break;
            }
            case 'own': {
                $session = $me->own();
            break;
            }
            case 'opened': {
                $session = $me->opened($now);
            break;
            }
            case 'locked': {
                $session = $me->locked($now);
            break;
            }
        }
        return view('survey.index',[
            'sessions' => $session,
            'now' => $now,
            'selected'=> $select
        ]);
    }
    public function all() {
        $session = DB::table('sessions')
                        ->where('type_id', 2)
                        ->orderBy('updated_at', 'desc')
                        ->get();
        return $session;
    }
    public function own() {
        $user = Auth::user();
        $session = $user->sessions->where('type_id', 2);
        return $session;
    }
    public function opened($now) {
        $session = DB::table('sessions')
                    ->where([
                        ['type_id','=', 2],
                        ['required','is',null]
                    ])
                    ->orderBy('updated_at', 'desc')
                    ->get();
        return $session;

    }
    public function locked($now) {
        $session = DB::table('sessions')
                    ->where([
                        ['type_id','=', 2],
                        ['required','is not',null]
                    ])
                    ->orderBy('updated_at', 'desc')
                    ->get();
        return $session;

    }
    
    public function newSurvey() {
        return view('survey.index',[
            'selected'=> 'own'
        ]);
    }



}
