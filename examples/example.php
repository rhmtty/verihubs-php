<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Rhmt\Verihubs\Requests\Config;
use Rhmt\Verihubs\Requests\Request;
use Rhmt\Verihubs\Verihubs\IdCheck;
use Rhmt\Verihubs\Verihubs\Liveness;

// $appID = '97da3c54-fed3-4b03-a650-308bd833067a';
// $apiKey = 'knnThfxflw4gBUpH3hoUCJFm5W5DPNOI';

$VERIHUBS_APPID = 'your_appid';
$VERIHUBS_APIKEY = 'your_apikey';

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
    ->setNik('35191429079xxxxx')
    ->setName('Rohmat TY')
    ->setBirthDate('29-07-1998')
    ->setBirthPlace('Madiun')
    ->setEmail('rohmat.triy@gmail.com')
    ->setPhone('6285707839xxx')
    ->setImage($base64)
    ->get();

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
