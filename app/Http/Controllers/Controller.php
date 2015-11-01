<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SSDB;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $ssdb = null;
    public $db = null;

    public function __construct()
    {
        // get ssdb database config.
        $this->db = config('database.ssdb.default');
        // init ssdb.
        $this->ssdb = new SSDB\Client($this->db['host'], $this->db['port']);
    }
}
