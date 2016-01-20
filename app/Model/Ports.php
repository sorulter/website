<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ports extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = array('node_name', 'port');
}
