<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use Illuminate\Support\Facades\File;
use App\Create_suppliers;

class ExcelUploadController extends Controller
{
    public function uploadFile(){
        return view('excel-upload.upload');
    }
    public function importData(Request $request){
        if($request->isMethod('post')) {
            $file = Input::file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('uploads', $file_name);
            $results = Excel::load('uploads/' . $file_name, function ($reader) {
                $reader->all();
            })->get();
            foreach ($results as $result => $res) {
                foreach ($res as $r) {
                    $user = new User();
                    $user->name = $r->name;
                    $user->email = $r->email;
                    $user->password = bcrypt('supplier');
                    $user->role = 'suppliers';
                    $user->save();
                    $user_id = $user->id;
                    $sup_info = new Create_suppliers();
                    if ($sup_info->validate($request->all())) {
                        $sup_info->user_id = $user_id;
                        $sup_info->category = $r->category;
                        $sup_info->contact = $r->contact;
                        $sup_info->save();
                    }
                }
            }
        }
        return redirect('/excel-upload/')
            ->with('success-message','Uploaded Successfully !!');
    }

}
