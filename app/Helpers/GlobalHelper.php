<?php

namespace App\Helpers;

use App\Models\Setting;

class GlobalHelper
{
    public static function currentUrl()
    {
        return url()->current();
    }

    public static function getSiteInfo()
    {
        $information = json_decode(Setting::first()->company_information);
        return $information;
    }
}
