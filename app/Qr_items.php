<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qr_items extends Model
{
    protected $table = 'qr_item';

    protected $fillable = [
        'id',
        'qr_id',
        'item_name',
        'item_no',
        'quantity'
    ];
    protected $rules = array(
        'id' => 'required',
        'qr_id'  => 'required',
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
