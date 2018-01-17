<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\superUser;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class superUserController extends Controller
{
    public function saveUser(Request $request)
    {
        if($request->isMethod('post')){
            $user = new superUser;
            if($user->validate($request->all())){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role = $request->role;
                $user->save();
            }
            else{
                return redirect()->to('superuser')->withErrors($user->errors())->withInput();
            }
        }

        $type = DB::select(DB::raw("SHOW COLUMNS FROM users WHERE Field = 'role'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }

        return view('superuser.add_user', ['roles' => $enum]);
    }

    public function viewUsers(){
        $users = User::all();
        $type = DB::select(DB::raw("SHOW COLUMNS FROM users WHERE Field = 'role'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }

        return view('superuser.list', ['users' => $users, 'footer_js' => 'superuser.list-js', 'roles' => $enum]);
    }

    public function editUsers(Request $request){
        if($request->isMethod('post')){
            print_r($request->all());
        }
    }

}
