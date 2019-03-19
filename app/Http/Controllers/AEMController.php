<?php

namespace App\Http\Controllers;

use App\Create_suppliers;
use App\Qr_invitations;
use App\Qr_items;
use App\Quotation_requisition;
use App\Suppliers_category;
use App\Supplier_quotations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use DateTime;
use Illuminate\Support\Facades\Storage;

class AEMController extends Controller
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
        $cat = Suppliers_category::all();
//        $cat = null;
//        foreach ($categories as $ca){
//            $cat .= '{label:"'.$ca->category.'"},';
//        }
        if($request->isMethod('post')){
            $sup = new User();
            if($sup->validate($request->all())){
                $sup->name = $request->name;
                $sup->email = $request->email;
                $sup->password = bcrypt($request->password);
                $sup->role = 'suppliers';
                $sup->save();
                $user_id = $sup->id;
                $sup_info = new Create_suppliers();
                $sup_info->user_id = $user_id;
                if($request->category == ''){
                    $sup_info->category = 1;
                }else{
                $sup_info->category = $request->category;
                }
                $sup_info->contact = $request->contact;
                $sup_info->save();
                return redirect()
                    ->to('suppliers/add-supplier')
                    ->with('success-message', 'New Supplier added successfully!');
            }else{
                return redirect()
                    ->to('/suppliers/add-supplier')
                    ->withErrors($sup->errors());
            }
        }
        return view('suppliers.add', [
            'page' => 'supplier',
            'section' => 'add',
            'cat'=> $cat
        ]);
    }

    public function viewSupplier(Request $request){
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
        $cate = Suppliers_category::all();
        $cates = null;
        foreach ($cate as $ca){
            $cates .= '{label:"'.$ca->id.'",cname:"'.$ca->category.'"},';
        }
        //$cates = rtrim(',',$cates);
        $cur_order ='asc';
        if (isset($request->order)){
            $cur_order = $request->order;
        }
        $result = User::where('role', 'suppliers')
            ->orderBy('name',$cur_order)
            ->paginate(20);
        foreach($result as $supplier){
            $info = Create_suppliers::where('user_id', $supplier->id)->get();
            $supplier->info = $info;
            foreach ($info as $i){
                $cat = Suppliers_category::find($i->category);
                $supplier->cat = $cat;
            }
        }
        return view('suppliers.view', [
            'result'=> $result,
            'footer_js' => 'suppliers.view-js',
            'page' => 'view-supplier',
            'cur_order' => $cur_order,
            'cat' => $cate,
            'cates' => $cates
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
                $sup_det = Create_suppliers::where('user_id',$request->user_id)->get();
                foreach ($sup_det as $sd){
                    Create_suppliers::destroy($sd->id);
                }
                $sup_qu = Supplier_quotations::where('supp_id',$request->user_id)->get();
                foreach ($sup_qu as $sq){
                    Supplier_quotations::destroy($sq->id);
                }
                $sqr_inv = Qr_invitations::whereRaw("FIND_IN_SET($request->user_id,suppliers)")->get();
                    foreach ($sqr_inv as $sqi) {
                        $suppliers = explode(',', $sqi->suppliers);
                        for($i =0;$i < sizeof($suppliers);$i++){
                            if ($suppliers[$i] === $request->user_id) {
                                unset($suppliers[$i]);
                            }
                        }
                        $updated_sups = '';
                        foreach ($suppliers as $sup){
                            $updated_sups .= $sup . ',';
                        }
                        $sqi->suppliers = rtrim($updated_sups,',');
                        $sqi->save();
                    }
                $check = Qr_invitations::where('suppliers','=','')->get();
                    foreach ($check as $ch){
                        Qr_invitations::destroy($ch->id);
                    }
                return redirect()
                    ->to('suppliers/view-supplier')
                    ->with('success-message', 'Supplier Deleted Successfully !');
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
        $categories = Suppliers_category::all();
        if($request->isMethod('post')) {
            $qr = new Quotation_requisition();
            if ($qr->validate($request->all())) {
                for($i = 1; $i <= $request->count; $i++){
                    if($request->get('item_name' . $i) != null && $request->get('item_no' . $i) != null && $request->get('quantity' .$i) != null){
                        $qr_item = new Qr_items();
                        $qr_items['item_name'] = $request->get('item_name' . $i);
                        $qr_items['item_no'] = $request->get('item_no' . $i);
                        $qr_items['quantity']  = $request->get('quantity' .$i);
                        if(!$qr_item->validate($qr_items)){
                            return redirect()
                                ->to('/qr-orders/add-qr-order')
                                ->withErrors($qr_item->errors());
                        }
                    }
                }
                $qr->pr_id = $request->pr_id;
                $qr->pr_type = $request->pr_type;
                $qr->category = $request->category;
                $qr->status = 'requested';
                $qr->created_by = Auth::user()->name;;
                $qr->save();
                $qr_item_id = $qr->id;
                for($i = 1; $i <= $request->count; $i++){
                    if($request->get('item_name' . $i) != null && $request->get('item_no' . $i) != null && $request->get('quantity' .$i) != null){
                        $qr_items = Qr_items::Where('qr_id',$qr_item_id)->get();
                        foreach ($qr_items as $item){
                            if($item->item_no == $request->get('item_no'.$i)){
                                return redirect()
                                    ->to('/qr-orders/add-qr-order')
                                    ->with('error-message','Can not Add Same Items For Same PR !');
                            }
                        }
                        $qr_item = new Qr_items();
                        $qr_item->qr_id = $qr_item_id;
                        $qr_item->item_name = $request->get('item_name' . $i);
                        $qr_item->item_no = $request->get('item_no' . $i);
                        $qr_item->quantity  = $request->get('quantity' .$i);
                        $qr_item->save();
                        if($request->hasFile('item_file'.$i)) {
                            $image = $request->file('item_file'.$i);
                            $name = str_slug($request->get('item_no' . $i)).'.'.$image->getClientOriginalExtension();
                            $destinationPath = public_path('/uploads/items');
                            $image->move($destinationPath, $name);
                            $qr_item->item_file = $name;
                            $qr_item->save();
                        }
                    }
                }
                return redirect()
                    ->to('/qr-orders/add-qr-order')
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
            'cat' => $categories,
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
        $categories = Suppliers_category::all();
        $qrs = Quotation_requisition::latest()->paginate(20);
        foreach($qrs as $qr){
            $items = Qr_items::where('qr_id', $qr->id)->get();
            $qr->items = $items;
            $cate = Suppliers_category::find($qr->category);
            $qr->cate = $cate;
        }
        return view('qr_orders.view', [
            'qrs' => $qrs,
            'page' => 'view-qr-order',
            'footer_js' => 'qr_orders.view-js',
            'cat' => $categories,
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
                if($request->hasFile('item_file'.$i)) {
                    $image = $request->file('item_file'.$i);
                    $name = str_slug($request->get('item_no' . $i)).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/items');
                    $image->move($destinationPath, $name);
                    $qr_item->item_file = $name;
                    $qr_item->save();
                }
            }
            for($i = 1; $i <= $request->addCount; $i++){
                if($request->get('add_item_name' . $i) != null && $request->get('add_item_no' . $i) != null && $request->get('add_quantity' .$i) != null){
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
                            ->to('/qr-orders/view')
                            ->withErrors($qr_item->errors());
                    }
                }
            }
            $qr_elements = Qr_items::where('qr_id', $qr->id)->get();
            foreach($qr_elements as $qe){
                if($request->get('delete_item_no'.$qe->id) != null){
                    $count = 0;
                    foreach($qr_elements as $item){
                        $count++;
                    }
                    if($count < 2){
                        return redirect()
                            ->to('/qr-orders/view')
                            ->with('error-message', 'You can\'t delete all items!');
                    }else{
                        Qr_items::destroy($request->get('delete_item_no'.$qe->id));
                    }
                }
            }
            return redirect()
                ->to('/qr-orders/view')
                ->with('success-message', 'Quotation Requisition updated successfully!');
        }
    }

    public function deleteQRItem(Request $request){
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
            $qr_item = Qr_items::find($request->delete_item_id);
            $qr_items = Qr_items::where('qr_id', $qr_item->qr_id)->get();
            $count = 0;
            foreach($qr_items as $item){
                $count++;
            }
            if($count < 2){
                return redirect()
                    ->to('/qr-orders/view')
                    ->with('error-message', 'You can\'t delete this item! This is the only item remains!');
            }else{
                Qr_items::destroy($request->delete_item_id);
                return redirect()
                    ->to('/qr-orders/view')
                    ->with('success-message', 'Quotation Requisition Item deleted successfully!');
            }
        }
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
                $sq_itm = Supplier_quotations::where('item_id',$item->id)->get();
                foreach ($sq_itm as $sqitm){
                    Supplier_quotations::destroy($sqitm->id);
                }
                Qr_items::destroy($item->id);
            }
            $qr_inv = Qr_invitations::where('qr_id',$request->delete_id)->get();
            foreach ($qr_inv as $invd){
                Qr_invitations::destroy($invd->id);
            }
            return redirect()
                ->to('/qr-orders/view')
                ->with('success-message', 'Quotation Requisition deleted successfully!');
        }
    }
    public function createCategory(Request $request){
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
            $sup_cats = new Suppliers_category();
            if($sup_cats->validate($request->all())){
                $sup_cats->category = $request->category;
                $sup_cats->save();
                return redirect()
                    ->to('suppliers/create-category')
                    ->with('success-message','Category Created Successfully !');
            }else{
                return redirect()
                    ->to('suppliers/create-category')
                    ->with('error-message','Category Name Must be Unique !');
            }
        }
        $all_cat = Suppliers_category::orderBy('id','desc')->paginate(20);
        return view('suppliers.create-category',[
            'categories' => $all_cat,
            'footer_js' => 'suppliers.create-category-js'
        ]);
    }
    public function editCategory(Request $request)
    {
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        } else {
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['admin', 'executive', 'manager'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        if($request->isMethod('post')){
            $sup_e = Suppliers_category::find($request->cat_id);
            $sup_e -> category = $request -> category;
            $sup_e->save();
            return redirect()
                ->to('suppliers/create-category')
                ->with('success-message','Category Edited Successfully !');
        }
    }
    public function deleteCategory(Request $request){
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
            $sup_table = Create_suppliers::where('category',$request->cat_id)->get();
            foreach ($sup_table as $st){
                $st->category = 1;
                $st->save();
            }
            $qr_table = Quotation_requisition::where('category',$request->cat_id)->get();
            foreach($qr_table as $qt){
                $qt->category = 1;
                $qt->save();
            }
            Suppliers_category::destroy($request->cat_id);
            return redirect()
                ->to('suppliers/create-category')
                ->with('success-message','Category Deleted Successfully !');
        }
    }
    public function inviteSuppliers(Request $request){
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
        $suppliers = User::where('role', 'suppliers')->orderBy('name','asc')->get();
        foreach ($suppliers as $sup){
            $sup_details = Create_suppliers::where('user_id',$sup->id)->get();
            $sup->details = $sup_details;
            foreach ($sup_details as $sc){
                $sup_cat = Suppliers_category::find($sc->category);
                $sup->cat = $sup_cat;
            }
        }
        $sup_cat = Suppliers_category::all();
        foreach($qrs as $qr){
            $invitations = Qr_invitations::where('qr_id', $qr->id)->get();
            if($invitations->isNotEmpty()){
                foreach($invitations as $invitation){
                    $qr->invite = $invitation;
                }
            }
        }
        if($request->isMethod('post')) {
            $count = 0;
            foreach($qrs as $qr){
                if($request->get('suppliers'.$qr->id) != null){
                    if($request->get('action'.$qr->id) == 'edit'){
                        $invited = Qr_invitations::where('qr_id', $qr->id)->get();
                        foreach($invited as $in){
                            $in->suppliers = rtrim($in->suppliers.','.$request->get('selected-suppliers'.$qr->id), ',');
                            $in->save();
                            $count++;
                        }
                    }
                    if($request->get('action_add_'.$qr->id) == 'add'){
                        $invitee = new Qr_invitations();
                        $invites['qr_id'] = $qr->id;
                        $invites['start_date'] = date('Y-m-d H:i:s', strtotime($request->get('start_date'.$qr->id)));
                        $invites['end_date'] = date('Y-m-d H:i:s', strtotime($request->get('end_date'.$qr->id)));

                        $invites['suppliers'] = $request->get('selected-suppliers'.$qr->id);
                        if($invitee->validate($invites)){
                            $invitee->qr_id = $qr->id;
                            $invitee->start_date = date('Y-m-d H:i:s', strtotime($request->get('start_date'.$qr->id)));
                            $invitee->end_date = date('Y-m-d H:i:s', strtotime($request->get('end_date'.$qr->id)));
                            $invitee->suppliers = rtrim($request->get('selected-suppliers'.$qr->id), ',');
                            $invitee->save();
                            $qr->status = 'invited';
                            $qr->save();
                            $count++;
                        }else{
                            return redirect()
                                ->to('/suppliers/invite-suppliers')
                                ->withErrors($invitee->errors());
                        }
                    }
                }
            }
            if($count == 0){
                return redirect()
                    ->to('/suppliers/invite-suppliers')
                    ->with('error', 'No Invitations were selected!');
            }else{
                return redirect()
                    ->to('/suppliers/invite-suppliers')
                    ->with('success-message', 'Invitations has been sent successfully!');
            }
        }
        return view('suppliers.invite', [
            'qrs' => $qrs,
            'categories' => $sup_cat,
            'suppliers' => $suppliers,
            'page' => 'invite',
            'footer_js' => 'suppliers.invite-js'
        ]);
    }

    public function supplierQuotations(Request $request){
        $quots = Supplier_quotations::where('status','=','requested')
            ->orWhere('status','=','rejected')
            ->orWhere('status','=','approved')
            ->orderBy('unit_price','desc')->get();
        $pr_ids = array();
        foreach($quots as $q){
            $item_details = Qr_items::where('id', $q->item_id)->get();
            foreach($item_details as $i){
                $qr_details = Quotation_requisition::where('id', $i->qr_id)->get();
                foreach ($qr_details as $d){
                    $pr_ids[] = $d->pr_id;
                }
            }
        }
        $pr_ids = array_unique($pr_ids);
        $allInvites = Qr_invitations::orderBy('start_date', 'desc')->paginate(20);
        foreach($allInvites as $invite){
            $today = (new DateTime())->format('Y-m-d');
            $expiry = (new DateTime($invite->end_date))->format('Y-m-d');
            $qr_det = Quotation_requisition::find($invite->qr_id);
            if(in_array($qr_det->pr_id, $pr_ids)){
                $invite->invited = 'yes';
                $invite->qr_details = $qr_det;
                $qr_items = Qr_items::Where('qr_id', $qr_det->id)->get();
                foreach ($qr_items as $item){
                    $sup_quo = Supplier_quotations::whereRaw('item_id ='.$item->id.' AND (status = "requested" OR status = "rejected" OR status = "approved")')
                        ->orderBy('unit_price', 'desc')->get();
                    if($sup_quo->first()) {
                        $item->ex = 'yes';
                        foreach ($sup_quo as $sq) {
                            if(strtotime($today) > strtotime($expiry)){
                                $sq->show_price = 'manager';
                                $sq->show_price_e = 'executive';
                                $sq->save();
                            }
                            $sup_name = User::find($sq->supp_id);
                            $sq->sup_details = $sup_name;
                        }
                        $item->supplierQuote = $sup_quo;
                    }
                }
                $invite->qr_items = $qr_items;
            }
        }
        return view('suppliers.quotations', [
            'allInvites' => $allInvites,
            'page' => 'quotations'
        ]);
    }

    public function tenderSummery(Request $request){
        if (!Auth::user()) {
            return redirect()
                ->to('/login')
                ->with('error-message', 'Please login first!');
        }else{
            $id = Auth::id();
            $user = User::find($id);
            if (!in_array($user->role, ['admin', 'executive', 'manager', 'director', 'super_userController'])) {
                return redirect()
                    ->back()
                    ->with('error-message', 'You don\'t have authorization!');
            }
        }
        $quots = Supplier_quotations::where('status','=','approved')
            ->orderBy('unit_price','desc')->get();
        $pr_ids = array();
        foreach($quots as $q){
            $item_details = Qr_items::where('id', $q->item_id)->get();
            foreach($item_details as $i){
                $qr_details = Quotation_requisition::where('id', $i->qr_id)->get();
                foreach ($qr_details as $d){
                    $pr_ids[] = $d->pr_id;
                }
            }
        }
        $pr_ids = array_unique($pr_ids);
        $allInvites = Qr_invitations::orderBy('start_date', 'desc')->paginate(20);
        foreach($allInvites as $invite){
            $qr_det = Quotation_requisition::find($invite->qr_id);
            if(in_array($qr_det->pr_id, $pr_ids)){
                $invite->invited = 'yes';
                $invite->qr_details = $qr_det;
                $qr_items = Qr_items::Where('qr_id', $qr_det->id)->get();
                foreach ($qr_items as $item){
                    $sup_quo = Supplier_quotations::whereRaw('item_id ='.$item->id.' AND (status = "approved")')
                        ->orderBy('unit_price', 'desc')->get();
                    if($sup_quo->first()) {
                        $item->ex = 'yes';
                        foreach ($sup_quo as $sq) {
                            $sup_name = User::find($sq->supp_id);
                            $sq->sup_details = $sup_name;
                        }
                        $item->supplierQuote = $sup_quo;
                    }
                }
                $invite->qr_items = $qr_items;
            }
        }
        return view('qr_orders.tender-summery', [
            'allInvites' => $allInvites,
            'page' => 'tender'
        ]);
    }
    public function uploadQRFile(){
        return view('qr_orders.upload');
    }
    public function importQRData(Request $request)
    {
        if ($request->isMethod('post')) {
            $file = Input::file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('uploads', $file_name);
            $results = Excel::load('uploads/' . $file_name, function ($reader) {
                $reader->all();
            })->toArray();
            foreach ($results as $result => $res) {
                if($res['pr_id'] != 0){
                    $keys = array_keys($res);
                    $item = strstr($res['pr_id'], '(');
                    $left = ltrim($item, '(');
                    $item_name = substr( $left, 0, -1 );
                    $item_no = strstr($res['pr_id'], '(', true);
                    $pr_id= strtoupper($keys[2]);
                    $pr_t = str_replace('_',' ',$keys[4]);
                    $pr_type = ucwords($pr_t);
                    if (Quotation_requisition::where('pr_id', '=', trim($pr_id))
                        ->Where('pr_type', '=', trim($pr_type))
                        ->Where('category', '=', 1)->exists()
                    ) {
                        $data = Quotation_requisition::where('pr_id', '=', trim($pr_id))->get();
                        foreach ($data as $d) {
                            $qr_item = new Qr_items();
                            $qr_item_id = $d->id;
                            $qr_item->item_name = trim($item_name);
                            $qr_item->item_no = trim(intval($item_no));
                            $qr_item->quantity = trim($res['status']);
                            $qr_item->qr_id = $d->id;
                            $qr_item->save();
                        }
                    } else {
                        $qr = new Quotation_requisition();
                        $qr->pr_id = trim($pr_id);
                        $qr->pr_type = trim($pr_type);
                        $qr->category = 1;
                        $qr->status = 'requested';
                        $qr->save();
                        $qr_item_id = $qr->id;
                        $qr_item = new Qr_items();
                        $qr_item->qr_id = $qr_item_id;
                        $qr_item->item_name = trim($item_name);
                        $qr_item->item_no = trim(intval($item_no));
                        $qr_item->quantity = trim($res['status']);
                        //$qr_item->quantity = trim($res->status);
                        $qr_item->save();
                    }
                }
            }
            return redirect('/qr-orders/upload-qr-order')
                ->with('success-message', 'Uploaded Successfully !!');
        }
    }
    public function uploadSuppliersFile(){
        return view('suppliers.upload');
    }
    public function importSuppliersData(Request $request){
        if($request->isMethod('post')) {
            $file = Input::file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('uploads', $file_name);
            $results = Excel::load('uploads/' . $file_name, function ($reader) {
                $reader->all();
            })->get();
            foreach ($results as $result => $res) {
                foreach ($res as $r) {
                    if(!User::where('email','=',$r->email)->exists()) {
                        $user = new User();
                        $user->name = trim($r->name);
                        $user->email = trim($r->email);
                        $user->password = bcrypt('supplier');
                        $user->role = 'suppliers';
                        $user->save();
                        $user_id = $user->id;
                        $sup_info = new Create_suppliers();
                        if ($sup_info->validate($request->all())) {
                            $sup_info->user_id = $user_id;
                            $sup_info->category = 1;
                            $sup_info->contact = trim($r->contact);
                            $sup_info->save();
                        }
                    }
                }
            }
        }
        return redirect('/suppliers/upload/')
            ->with('success-message','Uploaded Successfully !!');
    }
}
