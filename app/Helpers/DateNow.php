<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateNow
{
    public static function presentTime($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date);
    }
}
