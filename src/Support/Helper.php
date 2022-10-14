<?php

namespace Rhmt\Verihubs\Support;

class Helper
{
    public static function convertImageToBase64($image)
    {
        return base64_encode($image);
    }
}
