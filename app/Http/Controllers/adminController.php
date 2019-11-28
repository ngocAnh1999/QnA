<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\User;

class adminController extends Controller
{
    //
    public function index() {
        if(Auth::user()->roles->pluck( 'name' )->contains( 'super' )) {
            $users = DB::table('users')
            ->select('users.id', 'users.name','users.email','model_has_roles.role_id')
            ->join('model_has_roles','model_has_roles.model_id','=','users.id')
            ->get();
            return view('admin', ['users'=> $users]);
        }
        return redirect()->route('home');
    }
}
