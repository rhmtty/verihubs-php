<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Rhmt\Verihubs\Requests\Config;
use Rhmt\Verihubs\Requests\Request;
use Rhmt\Verihubs\Verihubs\IdCheck;
use Rhmt\Verihubs\Verihubs\Liveness;

$appID = 'yourAppID';
$apiKey = 'yourApiKey';

// 1. Set Config
$config = (new Config())
    ->setAppId($appID)
    ->setApiKey($apiKey);
// ->setDevelopment(true);

// 2. Setup Request
$request = new Request($config);

/*
|--------------------------------------------------------------------------
| Sampai disini seharusnya sudah bisa request transfer
|--------------------------------------------------------------------------
*/

$img = file_get_contents('./img.jpg');

// CONTOH: id check
// $idCheck = (new IdCheck($request))
//     ->setNik('3519142907980003')
//     // ->setName('') // Optional
//     // ->setBirthDate('') // Optional
//     // ->setBirthPlace('') // Optional
//     // ->setImage($img) // Optional
//     ->get();

// print_r($idCheck);
// // $res = json_decode($idCheck);
// // print_r($res);
// exit;


// CONTOH: Liveness
$liveness = (new Liveness($request))
    ->setImage($img)
    // ->setisQuality() // Optional
    // ->setIsAttribute() // Optional
    // ->setValidateQuality('') // Optional
    // ->setValidateAttribute('') // Optional
    ->get();

print_r($liveness);
// $responseObj = json_decode($liveness);
// print_r($responseObj);
exit;
