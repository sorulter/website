<?php

namespace app\Model;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    protected $fillable = ['user_id', 'invited_id', 'state', 'useable_date', 'flows_type', 'flows_amount'];
}
