<?php

namespace App\Http\Controllers;

use App\Create_suppliers;
use App\Qr_invitations;
use App\Qr_items;
use App\Quotation_requisition;
use App\User;
use Illuminate\Http\Request;
use Auth;

class SupplierController extends Controller
{
    protected function authCheck()
    {
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!$user->role == 'suppliers') {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
    }
    public function viewQR(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['suppliers', 'super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $id = Auth::id();
        $qr_inv = Qr_invitations::whereRaw("FIND_IN_SET($id,suppliers)")
            ->get();
        foreach ($qr_inv as $qr_item){
            $qr_tab = Qr_items::where('id','=',$qr_item->qr_id)
                ->get();
            $qr_item->qr_tab = $qr_tab;
        }
        return view('supplier-controller.view-qr')
            ->with('qr_inv',$qr_inv);
    }

    public function submitQuotations(Request $request){
        //
    }
        public function viewProfile(Request $request)
        {
            if (!Auth::user()) {
                return redirect()
                    ->to('/login')
                    ->with('error-message', 'Please login first!');
            }else{
                $id = Auth::id();
                $user = User::find($id);
                if (!in_array($user->role, ['suppliers'])) {
                    return redirect()
                        ->back()
                        ->with('error-message', 'You don\'t have authorization!');
                }
            }
            $result = User::where('role', 'suppliers')
                            ->where('id','=',$id)->get();
            foreach ($result as $supplier) {
                $info = Create_suppliers::where('user_id', '=', $supplier->id)->get();
                $supplier->info = $info;
            }
            return view('supplier-controller/profile')->with(array(
                'result' => $result
            ));
        }
        public function editProfile(Request $request){
            if (!Auth::user()) {
                return redirect()
                    ->to('/login')
                    ->with('error-message', 'Please login first!');
            }else{
                $id = Auth::id();
                $user = User::find($id);
                if (!in_array($user->role, ['suppliers'])) {
                    return redirect()
                        ->back()
                        ->with('error-message', 'You don\'t have authorization!');
                }
            }
        if($request->isMethod('post')){
            //print_r($request->all());
            $user = User::find($id);
            $user->name = $request->name;
            $user->save();
            $user_info = Create_suppliers::where('user_id' ,'=',$id)->first();
            $user_info->contact = $request->contact;
            $user_info->save();
            }else{
                return redirect()
                    ->to('/profile/')
                    ->withErrors($sup_info->errors());
            }
            return redirect()
                ->to('/profile/')
                ->with('success-message', 'Your Info updated successfully!');
        }
}
