<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class price_approval extends Model
{
    protected $table = 'price_approval';

    protected $fillable = [
        'manager',
        'executive'
    ];
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
