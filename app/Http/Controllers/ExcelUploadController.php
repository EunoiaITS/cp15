<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use Illuminate\Support\Facades\File;

class ExcelUploadController extends Controller
{
    public function uploadFile(){
        return view('excel-upload.upload');
    }
    public function importData(){
        $file = Input::file('file');
        $file_name = $file->getClientOriginalName();
        $file->move('uploads',$file_name);
        $results = Excel::load('uploads/'.$file_name,function($reader){
            $reader->all();
        })->get();

        return view('excel-upload.imported-data')
            ->with('results',$results);
    }

}
