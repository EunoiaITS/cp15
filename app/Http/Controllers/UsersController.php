<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
        }
        if($request->isMethod('post')){
            foreach ($user as $pass){
            if($pass['password'] != bcrypt($request->old_pass)){
                return redirect()->back()->withErrors("Old Password does not match");
            }elseif($request->new_pass != $request->retype_pass){
                return redirect()->back()->withErrors("New password does not match");
            }else{
                $user->password = bcrypt($request->new_pass);
                $user->save();
            }
            }
        }
        return view('users.change-password')->with('success-message', 'New Supplier added successfully!');;
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
