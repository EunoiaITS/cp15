<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Quotation_requisition extends Model
{
    protected $table = 'qr_table';

    protected $fillable = [
        'pr_id',
        'pr_type',
        'category'
    ];
    protected $rules = array(
        'pr_id'  => 'required',
        'pr_type' => 'required',
        'category' => 'required'
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
