<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Session;

class SessionController extends Controller
{
    //
    public function create() {
        return view('...');
    }
    public function store(Request $request) {
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
        $session->time_end = $time_start;
        $session->save();
        return view('qna.index');
    }
}
