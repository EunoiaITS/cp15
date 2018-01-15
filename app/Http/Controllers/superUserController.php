<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\superUser;

class superUserController extends Controller
{
    public function saveUser(Request $request)
    {
        if($request->isMethod('post')){
            $user = new superUser;
            $user->email = $request->email;
            $user->password = $request->password;
            if($user->validate($request->all())){
                $user->save();
            }
            else{
                return redirect()->back()->withErrors($user->errors())->withInput();
            }
        }
        return view('superuser.add_user');
    }
}
