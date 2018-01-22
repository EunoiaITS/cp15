<?php

namespace App\Http\Controllers;

use App\Create_suppliers;
use App\Qr_invitations;
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
            $sup->role = 'supplier';
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
                    ->to('/suppliers/add-supplier')
                    ->withErrors($sup_info->errors());
            }

            return redirect()
                ->to('suppliers/add-supplier')
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
                ->to('suppliers/view-supplier')
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
                    ->to('suppliers/view-supplier')
                    ->with('success-message', 'User deleted successfully!');
            }else{
                return redirect()
                    ->to('suppliers/view-supplier')
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
                    ->to('/qr-orders/add-qr-orders')
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
            $qr = Quotation_requisition::find($request->qr_id);
            $qr->pr_id = $request->pr_id;
            $qr->pr_type = $request->pr_type;
            $qr->category = $request->category;
            $qr->save();
            for($i = 1; $i <= $request->editCount; $i++){
                $qr_item = Qr_items::find($request->get('edit_id'.$i));
                $qr_item->item_name = $request->get('item_name'.$i);
                $qr_item->item_no = $request->get('item_no'.$i);
                $qr_item->quantity = $request->get('quantity'.$i);
                $qr_item->save();
            }
            for($i = 1; $i <= $request->addCount; $i++){
                $qr_item = new Qr_items();
                $qr_items['item_name'] = $request->get('add_item_name' . $i);
                $qr_items['item_no'] = $request->get('add_item_no' . $i);
                $qr_items['quantity']  = $request->get('add_quantity' .$i);
                if($qr_item->validate($qr_items)){
                    $qr_item->qr_id = $request->qr_id;
                    $qr_item->item_name = $request->get('add_item_name' . $i);
                    $qr_item->item_no = $request->get('add_item_no' . $i);
                    $qr_item->quantity  = $request->get('add_quantity' .$i);
                    $qr_item->save();
                }else{
                    return redirect()
                        ->to('/qr-orders/add-qr-order')
                        ->withErrors($qr_item->errors());
                }
            }
            return redirect()
                ->to('/qr-orders/view')
                ->with('success-message', 'Quotation Requisition updated successfully!');
        }
    }

    public function addQROrderExcel(Request $request){
        //
    }

    public function deleteQROrder(Request $request){
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
            Quotation_requisition::destroy($request->delete_id);
            $qr_items = Qr_items::where('qr_id', $request->delete_id)->get();
            foreach($qr_items as $item){
                Qr_items::destroy($item->id);
            }
            return redirect()
                ->to('/qr-orders/view')
                ->with('success-message', 'Quotation Requisition deleted successfully!');
        }
    }

    public function inviteSuppliers(Request $request){
//        print_r($request->all());
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
        $invite = Quotation_requisition::all();
        foreach ($invite as $inv){
            $suppliers = User::where('role','suppliers')->get();
            $inv->suppliers = $suppliers;
        }
        $qri = new Qr_invitations();
        if($request->isMethod('post')) {
            if ($qri->validate($request->all())) {
                $qri->qr_id = $request->pr_id;
                $qri->start_date = $request->start_date;
                $qri->end_date = $request->end_date;
                $qri->suppliers = $request->suppliers;
                $qri->save();
            }
        }
        foreach ($invite as $inv){
            $suppliers = User::where('role','supplier')->get();
            $inv->suppliers = $suppliers;
        }
        return view('suppliers.invite')->with(array(
            'invite'=>$invite,
            'suppliers'=>$suppliers,
            'footer_js' => 'suppliers.invite-js'));


    }

    public function supplierQuotations(Request $request){
        //
    }

    public function tenderSummery(Request $request){
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
        $qrs = Quotation_requisition::all();
        foreach($qrs as $qr){
            $qr_items = Qr_items::where('qr_id', $qr->id)->get();
            $qr->items = $qr_items;
        }
        return view('qr_orders.tender-summery', [
            'qrs' => $qrs,
            'page' => 'tender'
        ]);
    }
}
