<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapServer;
use App\Models\Country;
use App\Models\SoapRequest;

class SoapController extends Controller
{
    public function server(Request $request)
    {
        $options = ['uri' => $request->url()];
        $server = new SoapServer(null, $options);
        $server->setClass(SoapController::class);
        $server->handle();
    }

    public function getCountries()
    {
        return Country::all()->toArray();  
    }

    public function logRequest($data)
    {
        SoapRequest::create([
            'client_ip' => request()->ip(),
            'request_data' => json_encode($data),
            'callback_url' => request()->header('Callback-Url')
        ]);
    }
}

