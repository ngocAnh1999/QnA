<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Session;

class QnAController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $sessions = $user->sessions->where('type_id', 1);
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        return view('qna.index',[
            'sessions' => $sessions,
            'now' => $now
        ]);
    }
    public function create(Request $request) {
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
        return redirect('qna');
    }
    public function delete(Request $request) {
        $session = new Session;
        $session->findOrFail($request->del_id)->delete();
        return redirect('qna');
    }
    public function edit(Request $request) {
        $id = $request->id;
        $session = Session::find($id);
        $session->name = $request->name;
        $session->mota = $request->mota;
        $session->time_start = \DateTime::createFromFormat("H:i d-m-Y", $request->time_start);
        $session->time_end = \DateTime::createFromFormat("H:i d-m-Y", $request->time_end);
        $session->save();
        return redirect('qna');
    }
}
