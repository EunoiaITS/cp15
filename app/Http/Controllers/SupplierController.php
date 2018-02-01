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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class SupplierController extends Controller
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
        $qr_inv = Qr_invitations::whereRaw("FIND_IN_SET($id,suppliers)")->get();
        $count = Qr_invitations::whereRaw("FIND_IN_SET($id,suppliers)")->count();
        $quoted_items = array();
        $quotations = Supplier_quotations::whereRaw("FIND_IN_SET($id,supp_id)")->get();
        foreach($quotations as $quotation){
            $quoted_items[] = $quotation->item_id;
        }
        foreach ($qr_inv as $qr_tab){
            $qr_table = Quotation_requisition::where('id', $qr_tab->qr_id)->get();
            $qr_tab->qr_table = $qr_table;
            $qr_items = Qr_items::where('qr_id', $qr_tab->qr_id)->get();
            $qr_tab->items = $qr_items;
        }
        if($request->isMethod('post')) {
            $sup_quo = new Supplier_quotations();
                $sup_quo->item_id = $request->item_id;
                $sup_quo->unit_price = $request->unit_price;
                $sup_quo->comment = $request->comment;
                $sup_quo->supp_id = $id;
                $sup_quo->status = 'requested';
                $sup_quo->save();
                if($request->hasFile('attachment')){
                Storage::disk('uploads')->put('uploaded_file.'.$request->item_id.$id, $request->attachment);
                $files = File::allFiles(public_path().'/uploads/uploaded_file.'.$request->item_id.$id);
                $filePath = '';
                foreach($files as $file){
                    $filePath = (string)$file;
                }
                $fileName = explode('/', $filePath);
                $count = sizeof($fileName);
                $sup_quo->file = $fileName[($count-2)].'\\'.$fileName[($count-1)];
                $sup_quo->save();
            }
            return redirect('supplier-controller/view-qr')
                ->with('success-message', 'Your Quotation has been submitted Successfully !');
        }
        return view('supplier-controller.view-qr', [
            'qr_inv' =>  $qr_inv,
            'id'     =>  $id,
            'count' => $count,
            'quoted_items' => $quoted_items,
            'page'   =>  'view-qr'
        ]);
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
