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
        $d = Date::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

}
