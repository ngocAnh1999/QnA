<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QnAController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $sessions = $user->sessions;
        $now = Carbon::now();
        // foreach($sessions as $i => $session) {
        //     $status ='';
        //     $beforeNow = (new \DateTime($session->time_start))->getTimestamp() - $now->getTimestamp();
        //     $afterNow = (new \DateTime($session->time_end))->getTimestamp() - $now->getTimestamp();
        //     if($beforeNow > 0) {
        //         $status = 'chưa mở';
        //     }
        //     else if ($afterNow < 0) {
        //         $status = 'đã đóng';
        //     }
        //     else {
        //         $status = 'đang hoạt động';
        //     }
        //     array_push($session,['status'=>$status]);
        // }
        return view('qna.index',[
            'sessions' => $sessions,
            'now' => $now
        ]);
    }
}
