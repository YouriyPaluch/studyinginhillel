<?php

namespace Homework\PhpPro\Coder;

use GuzzleHttp\Exception\GuzzleException;
use Homework\PhpPro\Coder\Interfaces\IMyLogger;

class UrlOperator
{

    /**
     * @param UrlStorage $storage
     * @param IMyLogger $logger
     * @param UrlValidator $validator
     * @param UrlEncoder $encoder
     * @param UrlDecoder $decoder
     */
    public function __construct(
        protected UrlStorage $storage,
        protected IMyLogger $logger,
        protected UrlValidator $validator,
        protected UrlEncoder $encoder,
        protected UrlDecoder $decoder
    )
    {}

    /**
     * @param string $url
     * @return string
     * @throws GuzzleException
     */
    public function getUrlCode(string $url): string
    {
        $this->validator->isWorking($url);
        $code = $this->encoder->encode($url);
        return 'This URL has a code. Code: ' . $code;
    }

    /**
     * @param string $code
     * @return string
     */
    public function getUrl(string $code): string
    {
        return $this->decoder->decode($code);
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