<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Rhmt\Verihubs\Requests\Config;
use Rhmt\Verihubs\Requests\Request;
use Rhmt\Verihubs\Verihubs\IdCheck;

$appID = 'f339aec1-7bf5-4547-80fe-2c87550d9d12';
$apiKey = 'k9tHGSAh8fdZ8U7gOp+TDcOOaR+CNzm+';

// 1. Set Config
$config = (new Config())
    ->setAppId($appID)
    ->setApiKey($apiKey)
    ->setDevelopment(true);

// 2. Setup Request
$request = new Request($config);

/*
|--------------------------------------------------------------------------
| Sampai disini seharusnya sudah bisa request transfer
|--------------------------------------------------------------------------
*/

// Contoh id check
$idCheck = (new IdCheck($request))
    ->setNik('3539142907980003')
    ->get();

print_r($idCheck);
// $res = json_decode($idCheck);
// print_r($res);
exit;
