<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\superUser;
use Illuminate\Support\Facades\Session;

class superUserController extends Controller
{
    public function saveUser(Request $request)
    {
            $user = new superUser;
            $user->email = $request->email;
            $user->password = $request->password;
            if(!$user->errors()){
                $user->save();
                Session::flash('success','User created successfully');
            }
            else{
                
                return redirect()->to('superuser')->with('errors',$user->errors());
            }


    }
}
