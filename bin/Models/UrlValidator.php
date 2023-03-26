<?php

namespace Homework3\PhpPro\Models;

class UrlValidator {
    /**
     * @param string $url
     * @return void
     */
    public static function isUrl(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Url is not valid');
        }
    }

    /**
     * @param string $url
     * @return void
     */
    public static function isWorking(string $url)
    {
       $headers = get_headers($url);
       $responseCode = substr($headers[0], 9, 3);
       if ($responseCode != 200) {
           throw new \InvalidArgumentException('Url is not working');
       }
    }
}