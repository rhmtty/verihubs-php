<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Rhmt\Verihubs\Requests\Config;
use Rhmt\Verihubs\Requests\Request;
use Rhmt\Verihubs\Verihubs\IdCheck;
use Rhmt\Verihubs\Verihubs\Liveness;

$appID = '97da3c54-fed3-4b03-a650-308bd833067a';
$apiKey = 'knnThfxflw4gBUpH3hoUCJFm5W5DPNOI';

$VERIHUBS_APPID = '3330ce56-e22a-4ec2-b841-3bb2a15d1de7';
$VERIHUBS_APIKEY = 'AxOosiDuC+HVPLeFHMfmfuILhneX5z6D';

// 1. Set Config
$config = (new Config())
    ->setAppId($VERIHUBS_APPID)
    ->setApiKey($VERIHUBS_APIKEY);
// ->setDevelopment(true);

// 2. Setup Request
$request = new Request($config);

/*
|--------------------------------------------------------------------------
| Sampai disini seharusnya sudah bisa request transfer
|--------------------------------------------------------------------------
*/

$img = file_get_contents('./img.jpg');
$base64 = base64_encode($img);

// CONTOH: id check
$idCheck = (new IdCheck($request))
    ->setNik('3519142907980003')
    ->setName('Rohmat TY')
    ->setBirthDate('29-07-1998')
    ->setBirthPlace('Madiun')
    ->setEmail('rohmat.triy@gmail.com')
    ->setPhone('6285707839650')
    ->setImage($base64)
    ->get();

print_r($idCheck);
exit;
$res = json_decode($idCheck);
print_r($res);
exit;

/**
 * =============================================================================
 */

// CONTOH: Liveness
$liveness = (new Liveness($request))
    ->setImage($img)
    // ->setisQuality() // Optional
    // ->setIsAttribute() // Optional
    // ->setValidateQuality() // Optional
    // ->setValidateAttribute() // Optional
    ->get();

print_r($liveness);
// $responseObj = json_decode($liveness);
// print_r($responseObj);
exit;
