<?php

namespace App\Http\Controllers\User;

use Agent;
use App;
use App\Http\Controllers\Controller;
use Debugbar;
use Uuid;
use View;

class CellularController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!(Agent::is('iPhone') && Agent::is('Safari')) && !App::runningInConsole()) {
            return abort(404);
        }
    }

    /**
     * Display a listing of the cellular type.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('user.cellular.index');
    }

    /**
     * Generate mobileconfig
     *
     */
    public function getConfig($net)
    {
        Debugbar::disable();
        $ApnUUID = Uuid::generate();
        $ConfigUUID = Uuid::generate();
        $data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
        View::make('user.cellular.apn')
            ->with('apnName', $net)
            ->with('apnUUID', $ApnUUID)
            ->with('configUUID', $ConfigUUID)
            ->render();

        $path = base_path() . DIRECTORY_SEPARATOR; // my actual directory
        $signcert = file_get_contents($path . 'certs/iproxier.crt'); // my certificate to sign
        $privkey = file_get_contents($path . 'certs/iproxier.com.key'); // my private key of the certificate
        $extracerts = $path . 'certs/iproxier.chained.crt'; // the cert chain of my CA

        // write to tmp file
        file_put_contents('/tmp/' . $ApnUUID, $data);

        if (!openssl_pkcs7_sign('/tmp/' . $ApnUUID, '/tmp/' . $ConfigUUID, $signcert, $privkey, array(), PKCS7_NOATTR, $extracerts)) {
            return "Error!";
        }

        $signed = file_get_contents('/tmp/' . $ConfigUUID);
        $mobileconfig = base64_decode(preg_replace('/(.+\n)+\n/', '', $signed, 1));
        @unlink('/tmp/' . $ApnUUID);
        @unlink('/tmp/' . $ConfigUUID);

        return response($mobileconfig)
            ->header('Content-Type', 'application/x-apple-aspen-config');
    }
}
