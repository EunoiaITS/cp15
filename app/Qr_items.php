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
}
