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
        $supplier_quotation = Supplier_quotations::where('status','requested')->get();
        foreach ($supplier_quotation as $sup_quo){
            $qr_item = Qr_items::where('id','=',$sup_quo->item_id)->get();
            $sup_quo->qr_item = $qr_item;
            foreach($sup_quo->qr_item as $qr_tab){
                $qr = Quotation_requisition::where('id','=',$qr_tab->qr_id)->get();
                $qr_tab->qr = $qr;
                foreach ($qr_tab->qr as $qr_invite){
                    $inv = Qr_invitations::where('qr_id','=',$qr_invite->id)->get();
                    $qr_invite->inv = $inv;
                }
            }
        }
        return view('director.approve-quotations', [
            'page' => 'approve',
            'supplier_quotation' => $supplier_quotation
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
