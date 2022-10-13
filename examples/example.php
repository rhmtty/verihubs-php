<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Rhmt\Verihubs\Requests\Config;
use Rhmt\Verihubs\Requests\Request;
use Rhmt\Verihubs\Verihubs\IdCheck;
use Rhmt\Verihubs\Verihubs\Liveness;

$appID = env('appIdDev', '');
$apiKey = env('apiKeyDev', '');

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
    ->setName('') // Optional
    ->setBirthDate('') // Optional
    ->setBirthPlace('') // Optional
    ->setImage('') // Optional
    ->get();

// print_r($idCheck);
$res = json_decode($idCheck);
print_r($res->response->body);
exit;


// Contoh Liveness
$img = file_get_contents('./img.jpg');
$base64Img = base64_encode($img);

$liveness = (new Liveness($request))
    ->setImage($base64Img)
    ->setisQuality('') // Optional
    ->setIsAttribute('') // Optional
    ->setValidateQuality('') // Optional
    ->setValidateAttribute('') // Optional
    ->get();

$responseObj = json_decode($liveness);
print_r($responseObj->response->body);
exit;
