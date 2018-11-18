<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Supplier_quotations extends Model
{
    protected $table = 'supplier_quoatation';

    protected $fillable = [
      'unit_price'
    ];

    protected $rules = array(
        'unit_price' => 'numeric|between:0,99.99',
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
