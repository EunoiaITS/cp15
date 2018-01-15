<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier_quotations extends Model
{
    protected $table = 'supplier_quoatation';

    protected $fillable = [
        'id',
        'qr_id',
        'unit_price',
        'comment',
        'file'
    ];
}
