<?php

namespace App\Http\Controllers;

use App\Create_suppliers;
use App\Qr_invitations;
use App\Qr_items;
use App\Quotation_requisition;
use App\Supplier_quotations;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\File;

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
        foreach ($qr_inv as $qr_tab){
            $qr_table = Quotation_requisition::where('id','=',$qr_tab->qr_id)
                ->get();
            $qr_tab->qr_table = $qr_table;
        }
        foreach ($qr_inv as $qr_item){
            $qri = Qr_items::where('id','=',$qr_item->qr_id)
                ->get();
            $qr_item->qri = $qri;
        }
        if($request->isMethod('post')){
            if($request->hasFile('file')){
                $fileName = $request->file->getClientOriginalName();
                $ext = $request->file->getClientOriginalExtension();
                if(!in_array($ext, ['jpg', 'png','pdf'])){
                    return redirect()->back()->withErrors('File type not matched !');
                }else{
                    $id = Auth::id();
                    $path = public_path().'/storage/'.$id.'/';
                    $dir =File::makeDirectory($path,$mode = 0777, true,true);
                    if(!File::exists($dir)){
                        $filePath = $request->file->storeAs($dir,$fileName);
                        $sup_quo = new Supplier_quotations();
                        $sup_quo->item_id = $request->item_id;
                        $sup_quo->unit_price = $request->unit_price;
                        $sup_quo->comment = $request->comment;
                        $sup_quo->file = $filePath;
                        $sup_quo->supp_id = $request->supp_id;
                        $sup_quo->save();
                        return redirect('supplier-controller/view-qr')
                            ->with('success-message','Your Quotation has been submitted Successfully !');
                    }else{
                        return redirect('supplier-controller/view-qr')
                            ->with('error-message','Error !! Please try again !!');
                    }
            }
            }
        }
        return view('supplier-controller.view-qr', [
            'qr_inv' =>  $qr_inv,
            'id'     =>  $id,
            'page'   =>  'view-qr'
        ]);
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
        return view('supplier-controller/profile', [
            'result' => $result,
            'page' => 'profile'
        ]);
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
        }
        return redirect()
            ->to('/profile/')
            ->with('success-message', 'Your Info updated successfully!');
    }

}
