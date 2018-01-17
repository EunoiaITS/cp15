<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Qr_invitations extends Model
{
    protected $table = 'qr_invitation';

    protected $fillable = [
        'qr_id',
        'start_date',
        'end_date',
        'suppliers'
    ];
    protected $rules = array(
        'name'  => 'required',
        'email' => 'required',
        'category' => 'required',
        'contact' => 'required'
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
