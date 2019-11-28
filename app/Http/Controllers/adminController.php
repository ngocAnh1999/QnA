<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
            $roles = DB::table('roles')->get();
            return view('admin', [
                'users'=> $users,
                'roles'=>$roles
                ]);
        }
        return redirect()->route('home');
    }
    public function add(Request $request) {
        if(Auth::user()->roles->pluck( 'name' )->contains( 'super' )) {
            $user = User::find($request->id);
            if(isset($request->role_id)) {
                $role = Role::findOrFail($request->role_id);
                $user->assignRole($role->name);
            }
            return redirect()->route('admin');
        }
        return abort(404,'Page not found');
    } 
    public function edit(Request $request) {
        if(Auth::user()->roles->pluck( 'name' )->contains( 'super' )) {
            $user = User::find($request->id);
            if(isset($request->role_id)) {
                $user->removeRole($request->role_name);
                $role = Role::findOrFail($request->role_id);
                $user->assignRole($role->name);

            }
            return redirect()->route('admin');
        }
        return abort(404,'Page not found');
    } 
    // public function delete(Request $request) {
    //     if(Auth::user()->roles->pluck( 'name' )->contains( 'super' )) {
            
    //         return redirect()->route('admin');
    //     }
    //     return abort(404,'Page not found');
    // } 
}
