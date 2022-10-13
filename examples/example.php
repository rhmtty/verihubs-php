<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Rhmt\Verihubs\IdCheck;
use Rhmt\Verihubs\Requests\Config;
use Rhmt\Verihubs\Requests\Request;

$appID = '97da3c54-fed3-4b03-a650-308bd833067a';
$apiKey = 'i1WjxnLqC1cAXmCCQTXW/v/KJXaM9k40';

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
    ->setName('Rohmat Tri Yulianto')
    ->setBirthDate('29-07-1998');

$res = $idCheck->get();
echo json_encode(json_decode($tf), JSON_PRETTY_PRINT);
exit;
