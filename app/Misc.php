<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Misc extends Model
{
    protected $table = 'misc';

    protected $fillable = [
        'id',
        'key',
        'value'
    ];
    protected $rules = array(
        'id' => 'required',
        'key'  => 'required',
        'value' => 'required'
    );
    protected $errors;

    public function validate($data)
    {
        $valid = Validator::make($data, $this->rules);
        if ($valid->fails())
        {
            $this->errors = $valid->errors;
            return false;
        }
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

}
