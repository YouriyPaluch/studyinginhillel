<?php

namespace Homework\PhpPro\Models;

use GuzzleHttp\Client;
use Homework\PhpPro\Interfaces\IMyLogger;

class UrlOperator
{
    /**
     * @var UrlStorage
     */
    protected UrlStorage $storage;

    protected IMyLogger $logger;

    /**
     * @param string $filePath
     */
    public function __construct(protected string $filePath)
    {
        $this->storage = new UrlStorage($filePath);
        $this->logger = new MyLogger($filePath);
    }

    /**
     * @param string $url
     * @return string
     */
    public function getUrlCode(string $url): string
    {
        $validator = new UrlValidator(new Client(), $this->logger);
        $validator->isUrl($url);
        $validator->isWorking($url);
        $encoder = new UrlEncoder($this->storage);
        $code = $encoder->encode($url);
        return 'This URL has a code. Code: ' . $code;
    }

    /**
     * @param string $code
     * @return string
     */
    public function getUrl(string $code): string
    {
        $decoder = new UrlDecoder($this->storage, $this->logger);
        return $decoder->decode($code);
    }

    /**
     * @param string $string
     * @return string
     */
    public function startApplication(string $string): string
    {
        if (filter_var($string, FILTER_VALIDATE_URL)) {
            return $this->getUrlCode($string);
        } else {
            return $this->getUrl($string);
        }
    }
}