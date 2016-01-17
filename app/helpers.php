<?php
namespace App;

use Hashids;

function id2hash($id)
{
    return Hashids::encode($id);
}
