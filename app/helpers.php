<?php

if (!function_exists('getCurrentPageSecondSegment')) {
    function getUrlSegment()
    {
        $url = request()->url();
        $path = parse_url($url, PHP_URL_PATH);
        $segments = explode('/', $path);

        $topicsIndex = array_search('staff', $segments);

        if ($topicsIndex !== false) {
            $topicsString = $segments[$topicsIndex];

            if ($topicsString == 'staff'){
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }
}
