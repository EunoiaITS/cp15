<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation_requisition extends Model
{
    protected $table = 'qr_table';

    protected $fillable = [
        'id',
        'pr_id',
        'pr_type',
        'category'
    ];
}
