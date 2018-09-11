<?php

namespace App\Http\Controllers;

// use Log;
// use File;
// use Excel;
// use Cache;
// use Cookie;
// use Session;
use DateTime;
use Response;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $client;

    public function __construct () {
    	$this->client = new Client([
		    // Base URI is used with relative requests
		    'base_uri' => config('app.API_URL'),
		    // You can set any number of default request options.
		    'timeout'  => 100.0,
		]);
    }

    public function doPost ($url, $params) {

        $response = $this->client->post($url, [
            'form_params' => $params
        ])->getbody()->getContents();

        return $response;
    }

    public function getip () {
        return $this->GetClientIp();
    }

    public function GetClientIp () {
        $ip = 'Unknow IP';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $this->is_ip($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:$ip;
        }else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $this->is_ip($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$ip;
        }else{
            return $this->is_ip($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:$ip;
        }
    }
    
    public function is_ip ($str) {
        $ip = explode('.',$str);
        for ($i = 0; $i < count($ip); $i++) {
            if ($ip[$i] > 255) {
                return false; 
            } 
        } 
        return preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$str);
    }

    public function ISASTView ($view, $datas = []) {
        return View($view, $datas);
    }
}
