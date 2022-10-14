# verihubs-php
Integration library for Verihubs
## Installation
```
composer require rhmt/verihubs-php
```
## Usage
```php
<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Rhmt\Verihubs\Requests\Config;
use Rhmt\Verihubs\Requests\Request;
use Rhmt\Verihubs\Support\Helper;
use Rhmt\Verihubs\Verihubs\IdCheck;
use Rhmt\Verihubs\Verihubs\Liveness;

$appID = 'your_appID';
$apiKey = 'yourApikey';

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
$base64Image = Helper::convertImageToBase64($img);

// CONTOH: id check
// $idCheck = (new IdCheck($request))
//     ->setNik('3519142907980003')
//     // ->setName('') // Optional
//     // ->setBirthDate('') // Optional
//     // ->setBirthPlace('') // Optional
//     // ->setImage($base64Image) // Optional
//     ->get();

// print_r($idCheck);
// // $res = json_decode($idCheck);
// // print_r($res);
// exit;


// CONTOH: Liveness
$liveness = (new Liveness($request))
    ->setImage($base64Image)
    // ->setisQuality() // Optional
    // ->setIsAttribute() // Optional
    // ->setValidateQuality('') // Optional
    // ->setValidateAttribute('') // Optional
    ->get();

print_r($liveness);
// $responseObj = json_decode($liveness);
// print_r($responseObj);
exit;
```
