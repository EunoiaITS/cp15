<?php

namespace App\Http\Controllers;

use App\Qr_items;
use App\Quotation_requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AEMController extends Controller
{
    public function addSupplier(Request $request){
        //
    }

    public function editSupplier(Request $request){
        //
    }

    public function addSupplierExcel(Request $request){
        //
    }

    public function deleteSupplier(Request $request){
        //
    }

    public function addQROrder(Request $request){
        if($request->isMethod('post')) {
            //print_r($request->all());
            $qr = new Quotation_requisition();
            if ($qr->validate($request->all())) {
                $qr->pr_id = $request->pr_id;
                $qr->pr_type = $request->pr_type;
                $qr->category = $request->category;
                $qr->save();
                $qr_item_id = $qr->id;
                for($i = 1; $i <= $request->count; $i++){
                    $qr_item = new Qr_items();
                    $qr_items['item_name'] = $request->get('item_name' . $i);
                    $qr_items['item_no'] = $request->get('item_no' . $i);
                    $qr_items['quantity']  = $request->get('quantity' .$i);
                    if($qr_item->validate($qr_items)){
                        $qr_item->qr_id = $qr_item_id;
                        $qr_item->item_name = $request->get('item_name' . $i);
                        $qr_item->item_no = $request->get('item_no' . $i);
                        $qr_item->quantity  = $request->get('quantity' .$i);
                        $qr_item->save();
                    }else{
                        return redirect()
                            ->to('/qr-orders')
                            ->withErrors($qr_item->errors());
                    }
                }
                return redirect()
                    ->to('/qr-orders')
                    ->with('success-message', 'Quotation requisition added successfully!');
            } else {
                return redirect()
                    ->to('/qr-orders')
                    ->withErrors($qr->errors())
                    ->withInput();
            }
        }
    }
    public function editQROrder(Request $request){
        //
    }

    public function addQROrderExcel(Request $request){
        //
    }

    public function deleteQROrder(Request $request){
        //
    }

    public function inviteSuppliers(Request $request){
        //
    }

    public function supplierQuotations(Request $request){
        //
    }

    public function tenderSummery(Request $request){
        //
    }
}
