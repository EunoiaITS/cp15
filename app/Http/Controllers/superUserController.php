<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\superUser;

class superUserController extends Controller
{
    public function saveUser(Request $request)
    {
            $user = new superUser;
            $user->email = $request->email;
            $user->password = $request->password;
            if(!$user->errors()){
                $user->save();
            }
            else{
                return redirect()->to('superuser')->with('errors',$user->errors());
            }


    }
}
