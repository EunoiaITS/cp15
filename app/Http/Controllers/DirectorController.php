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
use Illuminate\Support\Facades\View;

class DirectorController extends Controller
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
        $asc_result = User::where('role', 'suppliers')
            ->orderBy('name','asc')
            ->paginate(30);
        $desc_result = User::where('role', 'suppliers')
            ->orderBy('name','desc')
            ->paginate(30);
        foreach($asc_result as $supplier){
            $info = Create_suppliers::where('user_id', '=', $supplier->id)->get();
            $supplier->info = $info;
        }
        foreach($desc_result as $supplier){
            $info = Create_suppliers::where('user_id', '=', $supplier->id)->get();
            $supplier->info = $info;
        }
        return view('director.suppliers-list', [
            'asc_result'=> $asc_result,
            'desc_result'=> $desc_result,
            'page' => 'view-supplier',
            'footer_js' => 'director.suppliers-js'
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
        $quots = Supplier_quotations::where('status','=','requested')
            ->orWhere('status','=','rejected')->get();
        $item_suppliers = array();
        $item_prices = array();
        $item_ids = array();
        $pr_ids = array();
        $pr_unique = array();
        foreach($quots as $q){
            $item_ids[] = $q->item_id;
            $item_details = Qr_items::where('id', $q->item_id)->get();
            $q->item_details = $item_details;
            foreach($item_details as $i){
                $qr_details = Quotation_requisition::where('id', $i->qr_id)->get();
                $q->qr_details = $qr_details;
                foreach ($qr_details as $d){
                    $pr_ids[] = $d->pr_id;
                    $dates = Qr_invitations::where('qr_id',$d->id)->get();
                    $q->dates = $dates;
                }
            }
            $supplier = User::find($q->supp_id);
            $q->supplier_details = $supplier;
        }
        $pr_ids = array_unique($pr_ids);
        $quotations = new \stdClass();
        $count = 0;
        foreach ($pr_ids as $pr){
            $count++;
            $pr_details = new \stdClass();
            $qr_id = Quotation_requisition::Where('pr_id',$pr)->first();
            $pr_details->qr_details = $qr_id;
            $qr_dates = Qr_invitations::Where('qr_id',$qr_id->id)->first();
            $pr_details->qr_dates = $qr_dates;
            $items = Qr_items::Where('qr_id',$qr_id->id)->get();
            foreach ($items as $item){
                $sup_quo = Supplier_quotations::Where('item_id',$item->id)
                            ->Where('status','=','requested')
                            ->orWhere('status','=','rejected')->get();
                if($sup_quo->first()) {
                    $sq_cl = new \stdClass();
                    $sq_count = 0;
                    $item->ex = 'yes';
                    foreach ($sup_quo as $sq) {
                        $sq_count ++;
                        $sup_name = User::find($sq->supp_id);
                        $sq_cl->sup_details = $sup_name;
                        $sq_cl->comment = $sq->comment;
                        $sq_cl->unit_price = $sq->unit_price;
                        $sq_cl->status = $sq->status;
                        $sq_cl->id = $sq->id;
                        $sq_cl->file = $sq->file;
                    }
                    $item->quotations = $sup_quo;
                }
            }
            $pr_details->sup_quo = $items;
            $quotations->$count = $pr_details;
        }
        if($request->isMethod('post')){
            $items = array();
            foreach ($quots as $check){
                if($request->get('state'.$check->id) != null){
                    $quot_check = Supplier_quotations::find($check->id);
                    $items[] = $quot_check->item_id;
                    if(count($items) != count(array_unique($items))){
                        return redirect()
                            ->to('/approve-quotations')
                            ->with('error-message',' Can not Approve Multiple Suppliers for same Item !');
                    }
                }
            }
            foreach($quots as $edit){
                $quot_edit = Supplier_quotations::find($edit->id);
                if($request->get('state'.$edit->id) != null){
                    if(Supplier_quotations::where('status','=','approved')
                        ->where('item_id',$quot_edit->item_id)->exists()){
                        return redirect()
                            ->to('/approve-quotations')
                            ->with('error-message',' Quotation Already Approved !');
                    }
                    $sup_qrs = Create_suppliers::where('user_id', $quot_edit->supp_id)->get();
                    foreach($sup_qrs as $sup_qr){
                        if($sup_qr->qr_id == null){
                            $sup_check = Create_suppliers::whereRaw("qr_id != ''")->get();
                            if($sup_check->isEmpty()){
                                $sup_qr->qr_id = 'QR'.sprintf("%08d",1);
                                $sup_qr->save();
                            }else{
                                $last_qr = null;
                                $to_sort = array();
                                foreach ($sup_check as $check){
                                    $to_sort[] = intval(str_replace('QR', '', $check->qr_id));
                                    sort($to_sort);
                                    $last_qr = $to_sort[(sizeof($to_sort)-1)];
                                }
                                $sup_qr->qr_id = 'QR'.sprintf("%08d", ($last_qr+1));
                                $sup_qr->save();
                            }
                        }
                    }
                    $quot_edit->status = 'approved';
                    $quot_edit->save();
                    $latest_id = $quot_edit->item_id;
                    $sup_q = Supplier_quotations::Where('item_id','=',$latest_id)
                        ->Where('status','=','requested')->get();
                    foreach ($sup_q as $sq){
                        $sq->status = 'rejected';
                        $sq->save();
                    }
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
            'quotations' => $quotations,
            'item_prices' => $item_prices,
            'item_suppliers' => $item_suppliers,
            'footer_js' => 'director.price-compare-js',
            'pr_ids' => $pr_ids

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
        $prs = array();
        foreach ($quotations as $quotation){
            $item = Qr_items::where('id', $quotation->item_id)->get();
            foreach($item as $qrid){
                $quo = Quotation_requisition::where('id', $qrid->qr_id)->get();
                $quotation->quo = $quo;
                foreach($quo as $q){
                    $prs[] = $q->pr_id;
                }
            }
        }
        $prs = array_unique($prs);
        $qrs = new \stdClass();
        foreach($prs as $pr){
            $qr = Quotation_requisition::where('pr_id', $pr)->get();
            foreach($qr as $qs){
                $var_count = 'qr'.$qs->id;
                $qrs->$var_count = $qs;
            }
        }
        if($request->isMethod('post')){
            foreach($qrs as $edit){
                $quot_edit = Quotation_requisition::find($edit->id);
                $qr_items = Qr_items::where('qr_id', $quot_edit->id)->get();
                if($request->get('manager'.$edit->id) != null){
                    $quot_edit->show_price_m = 'manager';
                    $quot_edit->save();
                    foreach($qr_items as $items){
                        $quots = Supplier_quotations::where('item_id', $items->id)->get();
                        foreach($quots as $qq){
                            $qq->show_price = 'manager';
                            $qq->save();
                        }
                    }
                }else{
                    $quot_edit->show_price_m = '';
                    $quot_edit->save();
                    foreach($qr_items as $items){
                        $quots = Supplier_quotations::where('item_id', $items->id)->get();
                        foreach($quots as $qq){
                            $qq->show_price = '';
                            $qq->save();
                        }
                    }
                }
                if($request->get('executive'.$edit->id) != null){
                    $quot_edit->show_price_e = 'executive';
                    $quot_edit->save();
                    foreach($qr_items as $items){
                        $quots = Supplier_quotations::where('item_id', $items->id)->get();
                        foreach($quots as $qq){
                            $qq->show_price_e = 'executive';
                            $qq->save();
                        }
                    }
                }else{
                    $quot_edit->show_price_e = '';
                    $quot_edit->save();
                    foreach($qr_items as $items){
                        $quots = Supplier_quotations::where('item_id', $items->id)->get();
                        foreach($quots as $qq){
                            $qq->show_price_e = '';
                            $qq->save();
                        }
                    }
                }
            }
            return redirect()
                ->to('/allow-price-show')
                ->with('success-message','Price show allowed!');
        }

        return view('director.allow-price-show', [
            'page' => 'allow',
            'quotations' => $qrs
        ]);
    }

    public function systemLog(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['director', 'super_userController', 'manager', 'executive', 'admin'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $page_no = 1;
        $amount = 10;
        $start = 1;
        $logs = new \stdClass();
        $invites = Qr_invitations::all();
        $delim = 0;
        foreach($invites as $invite){
            $pr_id = Quotation_requisition::where('id', $invite->qr_id)->first();
            $invite->pr_id = $pr_id->pr_id;
            $suppliers = explode(',', $invite->suppliers);
            foreach($suppliers as $s){
                $supplier = User::find($s);
                $delim++;
                $sup = new \stdClass();
                $sup->name = $supplier->name;
                $sup->details = $invite;
                $logs->$delim = $sup;
            }
        }
        $total_logs = 0;
        $logsPerPage = new \stdClass();
        foreach($logs as $log){
            $total_logs++;
        }
        if($total_logs < $amount){
            $amount = $total_logs;
        }
        if($request->page != null && $page_no != 1){
            $page_no = $request->page;
            $start = ($page_no * $amount) - 1;
        }
        for($i = $start; $i < ($start + $amount); $i++){
            $logsPerPage->$i = $logs->$i;
        }
        return view('director.logs', [
            'current' => $page_no,
            'page' => (($total_logs != 0) ? $total_logs/$amount : 0),
            'logs' => $logsPerPage,
            'log_page' => 'log'
        ]);
    }

}
