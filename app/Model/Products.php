<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = array('name', 'price', 'type', 'amount', 'describe');
}
