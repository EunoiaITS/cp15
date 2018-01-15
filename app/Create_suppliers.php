<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Create_suppliers extends Model
{
    protected $table = 'supplier';

    protected $fillable = [
        'id',
        'name',
        'email',
        'category',
        'contact'
    ];
}
