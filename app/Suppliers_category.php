<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Suppliers_category extends Model
{
    protected $table = 'suppliers_category';

    protected $fillable = [
        'category'
    ];

    protected $rules = array(
        'category'  => 'required|unique:suppliers_category'
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
