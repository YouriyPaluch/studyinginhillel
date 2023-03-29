<?php

namespace Homework\PhpPro\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Homework\PhpPro\Interfaces\IMyLogger;

class UrlOperator
{
    /**
     * @var UrlStorage
     */
    protected UrlStorage $storage;

    /**
     * @var IMyLogger|MyLogger
     */
    protected IMyLogger $logger;

    /**
     * @var UrlValidator
     */
    protected UrlValidator $validator;

    /**
     * @param string $filePath
     */
    public function __construct(protected string $filePath)
    {
        $this->storage = new UrlStorage($filePath . 'url-code.txt');
        $this->logger = new MyLogger($filePath);
        $this->validator = new UrlValidator(new Client(), $this->logger);
    }

    /**
     * @param string $url
     * @return string
     * @throws GuzzleException
     */
    public function getUrlCode(string $url): string
    {
        $this->validator->isWorking($url);
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
     * @throws GuzzleException
     */
    public function startApplication(string $string): string
    {
        if (empty($string)) {
            return 'Ви не ввели жодних данних';
        } elseif (str_starts_with($string, 'http')) {
            return $this->getUrlCode($string);
        } else {
            return $this->getUrl($string);
        }
    }
}