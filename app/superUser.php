<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class superUser extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password'
    ];
    protected $rules = [
        'name' => 'required|min:6|max:128',
        'email' => 'required|email|unique:users',
        'password'  => 'required|min:6|max:128',
        'role' => 'required'
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
