<?php

namespace Homework3\PhpPro\Models;

class UrlStorage
{
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
     * @param string $codeUrl
     * @param string $url
     * @return string
     */
    public function addToStorage(string $codeUrl, string $url): string
    {
        $stringToFile = $codeUrl . '->' . $url . '->' . PHP_EOL;
        return file_put_contents($this->filePath, $stringToFile, FILE_APPEND | LOCK_EX);
    }

    /**
     * @return string
     */
    public function getFromStorage(): string
    {
        return file_get_contents($this->filePath);
    }
}