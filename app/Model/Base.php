<?php namespace App\Model;

use SSDB\Client;

class Base
{
    // ssdb connector
    public $_ssdb;

    // name space
    public $_ns;

    // init
    public function __construct()
    {
        $config = config("database.ssdb.default");
        $this->_ns = $config['ns'];
        $this->_ssdb = new Client($config['host'], $config['port'], $config['timeout']);
    }
}
