<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class superUser extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'email', 'password',
    ];
    protected $rules = array(
        'email' => 'required|email',
        'password'  => 'required|min:6|max:128'
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
