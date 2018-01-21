<?php

namespace App\Http\Controllers;

use App\Create_suppliers;
use App\Qr_items;
use App\Quotation_requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class AEMController extends Controller
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
            if (!in_array($user->role, ['admin', 'executive', 'manager'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
    }

    public function addSupplier(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['admin', 'executive', 'manager'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        if($request->isMethod('post')){
            //print_r($request->all());
            $sup = new User();
            $sup->name = $request->name;
            $sup->email = $request->email;
            $sup->password = bcrypt('supplier');
            $sup->role = $request->role;
            $sup->save();
            $user_id = $sup->id;
            $sup_info = new Create_suppliers();

            if ($sup_info->validate($request->all())) {
                $sup_info->user_id = $user_id;
                $sup_info->category = $request->category;
                $sup_info->contact = $request->contact;
                $sup_info->save();
            }else{
                return redirect()
                    ->to('/suppliers/')
                    ->withErrors($sup_info->errors());
            }

            return redirect()
                ->to('/suppliers/')
                ->with('success-message', 'New Supplier added successfully!');
        }
        return view('suppliers.add', [
            'page' => 'supplier',
            'section' => 'add'
        ]);
    }

    public function viewSupplier(){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['admin', 'executive', 'manager'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $result = User::where('role', 'supplier')->get();
        foreach($result as $supplier){
            $info = Create_suppliers::where('user_id', '=', $supplier->id)->get();
            $supplier->info = $info;
        }
        return view('suppliers.view', [
            'result'=> $result,
            'footer_js' => 'suppliers.view-js',
            'page' => 'view-supplier'
        ]);
    }

    public function editSupplier(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['admin', 'executive', 'manager'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        if($request->isMethod('post')){
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $user_info = Create_suppliers::where('user_id' ,'=',$request->user_id)->first();
            $user_info->category = $request->category;
            $user_info->contact = $request->contact;
            $user_info->save();
            return redirect()
                ->to('suppliers/viewSupplier')
                ->with('success-message', 'User updated successfully!');
        }
    }

    public function addSupplierExcel(Request $request){
        //
    }

    public function deleteSupplier(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['admin', 'executive', 'manager'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        if($request->isMethod('post')){
            if($request->user_id != null){
                User::destroy($request->user_id);
                return redirect()
                    ->to('suppliers/viewSupplier')
                    ->with('success-message', 'User deleted successfully!');
            }else{
                return redirect()
                    ->to('suppliers/viewSupplier')
                    ->with('error-message', 'Something went wrong!');
            }
        }
    }

    public function addQROrder(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['admin', 'executive', 'manager'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
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
                            ->to('/qr-orders/add-qr-order')
                            ->withErrors($qr_item->errors());
                    }
                }
                return redirect()
                    ->to('/qr-orders')
                    ->with('success-message', 'Quotation requisition added successfully!');
            } else {
                return redirect()
                    ->to('/qr-orders/add-qr-order')
                    ->withErrors($qr->errors())
                    ->withInput();
            }
        }
        return view('qr_orders.add', [
            'page' => 'qr-order',
            'section' => 'add',
            'footer_js' => 'qr_orders.qr-orders-js'
        ]);
    }

    public function viewQROrder(Request $request){
        $qrs = Quotation_requisition::all();
        foreach($qrs as $qr){
            $items = Qr_items::where('qr_id', $qr->id)->get();
            $qr->items = $items;
        }
        return view('qr_orders.view', [
            'qrs' => $qrs,
            'page' => 'view-qr-order',
            'footer_js' => 'qr_orders.view-js'
        ]);
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
