<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\superUser;

class superUserController extends Controller
{
    public function saveUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = new superUser;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            flash('New superuser has been Created!you can login now')->success();

            return redirect()->route('/superuser');
        }
    }
}
