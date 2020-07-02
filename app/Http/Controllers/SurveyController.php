<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Session;
use App\Question;
use App\User;

class SurveyController extends Controller
{
    //
    public function index(string $select) {
        if(Auth::guest()){
            return redirect('home');
        }
        $me = $this;
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
                $session = $me->opened();
            break;
            }
            case 'locked': {
                $session = $me->locked();
            break;
            }
        }
        return view('survey.listSurvey',[
            'sessions' => $session,
            'selected'=> $select,
        ]);
    }
    public function all() {
        $session = DB::table('sessions')
                        ->select('sessions.id','sessions.name','sessions.mota','sessions.required',DB::raw('users.name as user_name'))
                        ->join('users','users.id','=','sessions.user_id')
                        ->where('sessions.type_id', 2)
                        ->orderBy('sessions.updated_at', 'desc')
                        ->get();
        return $session;
    }
    public function own() {
        $user = Auth::user();
        $session = DB::table('sessions')
                        ->select('sessions.id','sessions.name','sessions.mota','sessions.required',DB::raw('users.name as user_name'))
                        ->join('users','users.id','=','sessions.user_id')
                        ->whereRaw("sessions.type_id = 2 and sessions.user_id = $user->id")
                        ->orderBy('sessions.updated_at', 'desc')
                        ->get();
        return $session;
    }
    public function opened() {
        $session = DB::table('sessions')
                    ->select('sessions.id','sessions.name','sessions.mota','sessions.required',DB::raw('users.name as user_name'))
                    ->join('users','users.id','=','sessions.user_id')
                    ->whereRaw("sessions.type_id = 2 and sessions.required is null")
                    ->orderBy('sessions.updated_at', 'desc')
                    ->get();
        return $session;

    }
    public function locked() {
        $session = DB::table('sessions')
                    ->select('sessions.id','sessions.name','sessions.mota','sessions.required',DB::raw('users.name as user_name'))
                    ->join('users','users.id','=','sessions.user_id')
                    ->whereRaw("sessions.type_id = 2 and sessions.required is not null")
                    ->orderBy('sessions.updated_at', 'desc')
                    ->get();
        return $session;

    }
    
    public function create(Request $request) {
        $user = Auth::user();
        $session = new Session;
        $session->name = $request->sur_name;
        $session->mota = $request->sur_des;
        $session->user_id = $user->id;
        $session->type_id = 2;
        if($request->sur_pass != null || $request->sur_pass != "") {
            $session->required = trim($request->sur_pass);
        }
        $session->save();
        return redirect()->route('newSurvey',['id' => $session->id]);
        
    }
    
    public function delete(int $id) {
        $session = new Session;
        $questions = $session->findOrFail($id)->questions;
        foreach($questions as $question) {
            $answers = $question->answers;
            foreach($answers as $answer) {
                $users = $answer->pickedByUsers;
                $answer->pickedByUsers()->toggle($users);
                $answer->delete();
            }
            $question->delete();
        }
        $session->findOrFail($id)->delete();
        return redirect()->route('survey', ['select' => 'all']);
    }


}
