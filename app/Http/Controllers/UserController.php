<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $authUser = auth()->user();
        if($authUser->hasRole('user') || $authUser->hasRole('admin') || $authUser->hasRole('super-admin')){
            $users = User::all()->toArray();
            return $users;
        }
    }
    public function store(Request $request) {
        $authUser = auth()->user();
        if( $authUser->hasRole('admin') || $authUser->hasRole('super-admin')){
            $user = new User([
                'name' => $request->input('name'), 
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')), 
            ]);
            $user->save();
            return response()->json('User created!');
        }
        return response()->json('User not have permission!');
    }

    public function destroy($id) {
        $authUser = auth()->user();
        if( $authUser->hasRole('super-admin')){
            $user = User::find($id);
            $user->delete();
            return response()->json('User deleted!');
        }else{

            return response()->json('User not have permission!');
        }
    }
}

