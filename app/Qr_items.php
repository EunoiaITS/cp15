<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Qr_items extends Model
{
    protected $table = 'qr_item';

    protected $fillable = [
        'item_name',
        'item_no',
        'quantity'
    ];
    protected $rules = array(
        'item_name' => 'required',
        'item_no' => 'required',
        'quantity' => 'required'
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
