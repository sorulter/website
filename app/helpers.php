<?php
namespace App;

use Hashids;

function id2hash($id)
{
    return Hashids::encode($id);
}

function shortcode($content = null)
{
    $user = request()->user();
    $pac = env('PAC_BASE_URL') . id2hash($user->id);
    $server = $user->port->node_name . env('NODE_BASE_NAME');
    $port = $user->port->port;

    $content = mb_ereg_replace("\[pac\]", $pac, $content);
    $content = mb_ereg_replace("\[server\]", $server, $content);
    $content = mb_ereg_replace("\[port\]", $port, $content);

    return $content;
}
