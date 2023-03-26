<?php

namespace Homework3\PhpPro\Models;

use Homework3\PhpPro\Interfaces\IUrlDecoder;

class UrlDecoder implements IUrlDecoder {

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @param string $urlCode
     * @return string
     */
    public function decode(string $urlCode): string
    {
        $storage = new UrlStorage($this->filePath);
        $content = strstr($storage->getFromStorage(), $urlCode);
        if (!empty(explode('->', $content)[1])) {
            return explode('->', $content)[1];
        } else {
            return '';
        }

    }
}