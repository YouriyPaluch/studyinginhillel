<?php

namespace Homework\PhpPro\Core;

use Exception;
use InvalidArgumentException;
use TypeError;

class Config {

    /**
     * @var array
     */
    static protected array $configs = [];

    /**
     * @param string $configName
     * @param string $fileName
     * @param string $type
     * @return string
     */
    static public function get(string $configName, string $fileName = 'application', string $type = 'ini'): string
    {
        if (!is_string($fileName)) {
            throw new TypeError('Name of config must be string');
        }

        if (!array_key_exists($configName, self::$configs)) {
            $fileName = 'config/' . $fileName . '.' . $type;

            if (!file_exists($fileName)) {
                throw new InvalidArgumentException('File not exists');
            }

            self::$configs = parse_ini_file($fileName);
        }

        return self::$configs[$configName];
    }

}