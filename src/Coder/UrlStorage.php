<?php

namespace Homework\PhpPro\Coder;

use Homework\PhpPro\Core\Config;

class UrlStorage {

    public static function getUrlStorageF(): UrlStorageInFile
    {
        return new UrlStorageInFile(Config::get('dbFile'));
    }

    public static function getUrlStorageD(): UrlStorageInDB
    {
        return new UrlStorageInDB();
    }
}