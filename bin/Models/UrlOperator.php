<?php

namespace Homework3\PhpPro\Models;

class UrlOperator
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
     * @param string $url
     * @return string
     */
    public function getUrlCode(string $url): string
    {
        UrlValidator::isUrl($url);
        UrlValidator::isWorking($url);
        $encoder = new UrlEncoder();
        $urlCode = $encoder->encode($url);
        if ($this->getUrl($urlCode)) {
            return 'This URL has a code. Code: ' . $urlCode;
        } else {
            $storage = new UrlStorage('public/url-code.txt');
            if ($storage->addToStorage($urlCode, $url)) {
                return 'This URL was encode. Code: ' . $urlCode;
            } else {
                return 'This URL was not encode.';
            }
        }

    }

    /**
     * @param string $urlCode
     * @return string
     */
    public function getUrl(string $urlCode): string
    {
        $decoder = new UrlDecoder($this->filePath);
        return $decoder->decode($urlCode);
    }
}