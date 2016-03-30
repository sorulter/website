<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = array('name', 'price', 'type', 'amount', 'describe');
}
