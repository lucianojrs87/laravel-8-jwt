<?php

namespace App\Http\Lib;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Lib\EnumStatus;

use DateTime;

use Illuminate\Support\Facades\Date;

class FunctionsSystem
{

    public static function validateDate($date, $format = 'Y-m-d')
    {
        $format = 'Y-m-d';
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function validate_hour($input)
{
    $format = 'H:i';

    $date = DateTime::createFromFormat('!'. $format, $input);

    return $date && $date->format($format) === $input;
}

}
