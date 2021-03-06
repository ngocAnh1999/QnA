<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use App\Session;
use App\Question;
use App\Answer;
use App\User;

class QnAController extends Controller
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
            case 'activated': {
                $session = $me->activated($now);
            break;
            }
            case 'closed': {
                $session = $me->closed($now);
            break;
            }
        }
        return view('qna.index',[
            'sessions' => $session,
            'now' => $now,
            'selected'=> $select
        ]);
    }
    public function all() {
        $session = DB::table('sessions')
                        ->where('type_id', 1)
                        ->orderBy('updated_at', 'desc')
                        ->get();
        return $session;
    }
    public function own() {
        $user = Auth::user();
        $session = $user->sessions->where('type_id', 1);
        return $session;
    }
    public function activated($now) {
        $session = DB::table('sessions')
                    ->where([
                        ['type_id','=', 1],
                        ['time_start','<=',$now],
                        ['time_end','>=',$now]
                    ])
                    ->orderBy('updated_at', 'desc')
                    ->get();
        return $session;

    }
    public function closed($now) {
        $session = DB::table('sessions')
                    ->where([
                        ['type_id','=', 1],
                        ['time_end','<',$now]
                    ])
                    ->orderBy('updated_at', 'desc')
                    ->get();
        return $session;

    }

    public function create(Request $request, string $select) {
        if(Auth::guest()){
            return redirect('home');
        }
        $this->validate($request, [
            'name'=>'required|string|max:255',
            'mota'=>'required|string|max:1000',
            'time_start'=>'date_format:H:i d-m-Y',
            'time_end'=>'date_format:H:i d-m-Y'
        ]);
        $time_start = \DateTime::createFromFormat("H:i d-m-Y", $request->time_start);
        $time_end = \DateTime::createFromFormat("H:i d-m-Y", $request->time_end);
        $session = new Session;
        $session->user_id = Auth::user()->id;
        $session->type_id = 1;
        $session->name = $request->name;
        $session->mota = $request->mota;
        $session->time_start = $time_start;
        $session->time_end = $time_end;
        $session->save();
        return redirect()->route('qna', ['select' => $select]);
    }
    public function delete(Request $request, string $select) {
        $session = new Session;
        $questions = $session->findOrFail($request->del_id)->questions;
        foreach($questions as $question) {
            $answers = $question->answers;
            foreach($answers as $answer) {
                $users = $answer->pickedByUsers;
                $answer->pickedByUsers()->toggle($users);
                $answer->delete();
            }
            $question->delete();
        }
        $session->findOrFail($request->del_id)->delete();
        return redirect()->route('qna', ['select' => $select]);
    }
    public function edit(Request $request, string $select) {
        $id = $request->id;
        $session = Session::find($id);
        $session->name = $request->name;
        $session->mota = $request->mota;
        $session->time_start = \DateTime::createFromFormat("H:i d-m-Y", $request->time_start);
        $session->time_end = \DateTime::createFromFormat("H:i d-m-Y", $request->time_end);
        $session->save();
        return redirect()->route('qna', ['select' => $select]);
    }
}
