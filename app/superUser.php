<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class superUser extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'email', 'password',
    ];
    protected $rules = array(
        'email' => 'required',
        'password'  => 'required'
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
