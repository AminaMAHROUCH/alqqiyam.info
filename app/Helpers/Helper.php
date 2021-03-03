<?php

namespace App\Helpers;

class Helper
{

    public static function formatDate($date, $pattern = 'd/m/Y H:i')
    {
        return \Carbon\Carbon::parse($date)->format($pattern);
    }

    public static function formatDateP($date, $pattern = 'd/m/Y')
    {
        return \Carbon\Carbon::parse($date)->format($pattern);
    }
}