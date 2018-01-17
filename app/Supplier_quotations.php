<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Supplier_quotations extends Model
{
    protected $table = 'supplier_quoatation';

    protected $fillable = [
        'qr_id',
        'unit_price',
        'comment',
        'file'
    ];
    protected $rules = array(
        'qr_id'  => 'required',
        'unit_price' => 'required',
        'comment' => 'required',
        'file' => 'required'
    );
    protected $errors;

    public function validate($data)
    {
        $valid = Validator::make($data, $this->rules);
        if ($valid->fails())
        {
            $this->errors = $valid->errors();
            return false;
        }
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
