<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qr_invitations extends Model
{
    protected $table = 'qr_invitation';

    protected $fillable = [
        'id',
        'qr_id',
        'start_date',
        'end_date',
        'suppliers'
    ];
}
