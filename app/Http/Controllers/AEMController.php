<?php

namespace App\Http\Controllers;

use App\Quotation_requisition;
use Illuminate\Http\Request;

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
            $qr = new Quotation_requisition();
            if ($qr->validate($request->all())) {
                $qr->pr_id = $request->pr_id;
                $qr->pr_type = $request->pr_type;
                $qr->category = $request->category;
                $qr->save();
            } else {
                return redirect()->to('/qr-orders')->withErrors($qr->errors())->withInput();
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
