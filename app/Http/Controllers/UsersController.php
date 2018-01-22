<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    public function add(Request $request){
        //
    }

    public function edit(Request $request){
        //
    }

    public function delete(Request $request){
        //
    }

    public function allUsers(Request $request){
        //
    }

    public function changePassword(Request $request){
        //
    }

    public function login(Request $request){
        if(Auth::user()){
            return redirect()->to('/');
        }
        if($request->isMethod('post')){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect('/');
            }else{
                return redirect()->to('/login')->with('error-message', 'Wrong username/password!!');
            }
        }
        return view('users.login');
    }

    public function logout(){
        if(Auth::logout());
        return redirect('/login');
    }

    public function dashboard(){
        if(!Auth::user()){
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }
        return view('dashboard');
    }
}
