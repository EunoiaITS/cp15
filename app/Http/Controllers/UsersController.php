<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Supplier_quotations;
use Illuminate\Support\Facades\View;

class UsersController extends Controller

{
    public function __construct()
    {
        $sup_quo = Supplier_quotations::count();
        View::share('sup_quo_count', $sup_quo);

        $quo_app = Supplier_quotations::where('status','=','requested')->count();
        View::share('quo_approve', $quo_app);

        $tender = Supplier_quotations::where('status','=','approved')->count();
        View::share('tender', $tender);
    }
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
                if (!Hash::check($request->old_pass, Auth::user()->password)) {
                    return redirect()
                        ->to('/profile/change-password')
                        ->withErrors("Old Password does not match");
                }
                elseif($request->new_pass != $request->retype_pass){
                    return redirect()
                        ->to('/profile/change-password')
                        ->withErrors("New password does not match");
                }else{
                    $user->password = bcrypt($request->new_pass);
                    $user->save();
                    return redirect('/profile/change-password')
                        ->with('success-message', 'New password changed successfully!');
                }
            }
        return view('users.change-password');
    }

    public function login(Request $request){
        if(Auth::user()){
            return redirect()->to('/');
        }
        if($request->isMethod('post')){

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect('/');
            }else{
                return redirect()
                    ->to('/login')
                    ->with('error-message', 'Wrong username/password!!')
                    ->withInput();
            }
        }
        return view('users.login');
    }

    public function logout(){
        if(Auth::logout());
        return redirect('/login');
    }

    public function dashboard(){
        $id = Auth::id();
        $user = User::find($id);
        if(!Auth::user()){
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }elseif ($user->role == 'suppliers'){
            return redirect('/supplier-controller/view-qr/');
        }else{
        return view('dashboard');
        }
    }
}
