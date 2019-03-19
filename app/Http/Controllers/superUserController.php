<?php

namespace App\Http\Controllers;

use App\Create_suppliers;
use App\Qr_invitations;
use App\Qr_items;
use App\Quotation_requisition;
use App\User;
use Illuminate\Http\Request;
use App\superUser;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Supplier_quotations;

class superUserController extends Controller
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
    public function saveUser(Request $request)
    {
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        if($request->isMethod('post')){
            $user = new superUser;
            if($user->validate($request->all())){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role = $request->role;
                $user->save();
                if($user->role == 'suppliers'){
                    $sup = new Create_suppliers();
                    $sup->user_id = $user->id;
                    $sup->contact = '';
                    $sup->category = 1;
                    $sup->save();
                }
            }
            else{
                return redirect()
                    ->to('superuser')
                    ->withErrors($user->errors())
                    ->withInput();
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

        return view('superuser.add_user', [
            'roles' => $enum,
            'page' => 'user',
            'section' => 'add'
        ]);
    }

    public function viewUsers(){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $users = User::all();
        $type = DB::select(DB::raw("SHOW COLUMNS FROM users WHERE Field = 'role'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }

        return view('superuser.list', [
            'users' => $users,
            'footer_js' => 'superuser.list-js',
            'roles' => $enum,
            'page' => 'view-user'
        ]);
    }

    public function editUsers(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        if($request->isMethod('post')){
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->save();
            return redirect()
                ->to('superuser/users-list')
                ->with('success-message', 'User updated successfully!');
        }
    }

    public function deleteUsers(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        if($request->isMethod('post')){
            if($request->user_id != null){
                User::destroy($request->user_id);
                return redirect()
                    ->to('superuser/users-list')
                    ->with('success-message', 'User deleted successfully!');
            }else{
                return redirect()
                    ->to('superuser/users-list')
                    ->with('error-message', 'Something went wrong!');
            }
        }
    }

    public function deleteSavage(Request $request){
        $qrs = array();
        $qr_items = array();
        $qr_invites = array();
        $qr_quotes = array();
        $dates = array();
        $period = new \DatePeriod(
            new \DateTime('2018-01-01'),
            new \DateInterval('P1D'),
            new \DateTime('2018-08-31')
        );
        $dates[] = '2018-01-01';
        foreach ($period as $key => $value) {
            $dates[] = $value->format('Y-m-d');
        }
        $allQrs = Quotation_requisition::all();
        foreach($allQrs as $qr){
            if(in_array(date('Y-m-d', strtotime($qr->created_at)), $dates)){
                $qrs[] = $qr->id;
                $allItems = Qr_items::where('qr_id', $qr->id)
                    ->get();
                foreach($allItems as $item){
                    $qr_items[] = $item->id;
                    $allQuotes = Supplier_quotations::where('item_id', $item->id)
                        ->get();
                    foreach($allQuotes as $quote){
                        $qr_quotes[] = $quote->id;
                    }
                }
                $allInvites = Qr_invitations::where('qr_id', $qr->id)
                    ->get();
                foreach($allInvites as $invite){
                    $qr_invites[] = $invite->id;
                }
            }
        }
        Quotation_requisition::destroy($qrs);
        Qr_items::destroy($qr_items);
        Qr_invitations::destroy($qr_invites);
        Supplier_quotations::destroy($qr_quotes);
        die();
    }

}