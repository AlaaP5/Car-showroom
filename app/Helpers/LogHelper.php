<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class LogHelper
{
    public static function logInfo($channel, $status, $data = [])
    {
        Log::channel($channel)->info($status, $data);
    }

    public static function logWarning($channel, $status, $data = [])
    {
        Log::channel($channel)->warning($status, $data);
    }

    public static function logError($channel, $status, $data = [])
    {
        Log::channel($channel)->error($status, $data);
    }
}
