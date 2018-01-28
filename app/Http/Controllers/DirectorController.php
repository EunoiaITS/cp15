<?php

namespace App\Http\Controllers;

use App\price_approval;
use App\Qr_invitations;
use App\Supplier_quotations;
use Illuminate\Http\Request;
use App\User;
use App\Quotation_requisition;
use App\Qr_items;
use App\Create_suppliers;
use Auth;

class DirectorController extends Controller
{
    public function viewQR(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['director', 'super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $qrs = Quotation_requisition::all();
        foreach($qrs as $qr){
            $items = Qr_items::where('qr_id', $qr->id)->get();
            $qr->items = $items;
        }
        return view('director.qr-orders', [
            'qrs' => $qrs,
            'page' => 'qr-order',
            'footer_js' => 'director.qr-js'
        ]);
    }

    public function viewSuppliers(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['director', 'super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $result = User::where('role', 'suppliers')->get();
        foreach($result as $supplier){
            $info = Create_suppliers::where('user_id', '=', $supplier->id)->get();
            $supplier->info = $info;
        }
        return view('director.suppliers-list', [
            'result'=> $result,
            'page' => 'view-supplier'
        ]);
    }

    public function approveQuotations(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['director', 'super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $quotations = Supplier_quotations::where('status','=','requested')->get();
        foreach($quotations as $q){
            $item_details = Qr_items::where('id', $q->item_id)->get();
            $q->item_details = $item_details;
            foreach($item_details as $i){
                $qr_details = Quotation_requisition::where('id', $i->qr_id)->get();
                $q->qr_details = $qr_details;
                foreach ($qr_details as $d){
                    $dates = Qr_invitations::where('qr_id',$d->id)->get();
                    $q->dates = $dates;
                }
            }
            $supplier = User::find($q->supp_id);
            $q->supplier_details = $supplier;
        }
        if($request->isMethod('post')){
            foreach($quotations as $edit){
                $quot_edit = Supplier_quotations::find($edit->id);
                if($request->get('state'.$edit->id) != null){
                    if($quot_edit->status != 'approved'){
                            $count = Create_suppliers::count();
                            $sup_qr = new Create_suppliers();
                            $sup_qr->qr_id = 'QR'.sprintf("%08d", ($count+1));
                            $sup_qr->save();
                        }
                    $quot_edit->status = 'approved';
                    $quot_edit->save();
                }else{
                    $quot_edit->status = 'requested';
                    $quot_edit->save();
                }
            }
            return redirect()
                ->to('/approve-quotations')
                ->with('success-message',' Quotation Approved Status Changed!!');
        }

        return view('director.approve-quotations', [
            'page' => 'approve',
            'quotations' => $quotations
        ]);
    }

    public function allowPriceShow(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['director', 'super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $quotations = Supplier_quotations::all();
        foreach ($quotations as $quotation){
            $item = Qr_items::where('id', $quotation->item_id)->get();
            foreach($item as $qrid){
                $quo = Quotation_requisition::where('id', $qrid->qr_id)->get();
                $quotation->quo = $quo;
            }
        }
        if($request->isMethod('post')){
            foreach($quotations as $edit){
                $quot_edit = Supplier_quotations::find($edit->id);
                if($request->get('manager'.$edit->id) != null){
                    $quot_edit->show_price = 'manager';
                    $quot_edit->save();
                }else{
                    $quot_edit->show_price = '';
                    $quot_edit->save();
                }
                if($request->get('executive'.$edit->id) != null){
                    $quot_edit->show_price_e = 'executive';
                    $quot_edit->save();
                }else{
                    $quot_edit->show_price_e = '';
                    $quot_edit->save();
                }
            }
            return redirect()
                ->to('/allow-price-show')
                ->with('success-message','Price show allowed!');
        }

        return view('director.allow-price-show', [
            'page' => 'allow',
            'quotations' => $quotations
        ]);
    }
}
