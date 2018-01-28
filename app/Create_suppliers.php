<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Create_suppliers extends Model
{
    protected $table = 'suppliers';

    protected $rules = array(
        'category'  => 'nullable',
        'contact' => 'nullable',
        'qr_id' => 'nullable'
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
