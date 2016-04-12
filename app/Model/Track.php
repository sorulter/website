<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{

    protected $fillable = array('day', 'type', 'source', 'referrer', 'ip', 'status', 'count');
}
