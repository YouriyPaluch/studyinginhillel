<?php

namespace Homework\PhpPro\Core;

use Homework\PhpPro\Coder\UrlOperator;

class CoderController {

    public function __construct(
        protected UrlOperator $urlOperator
    )
    {}

    /**
     * @param string $url
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addAction(string $url): string
    {
        return $this->urlOperator->getUrlCode($url);
    }

    /**
     * @param string $code
     * @return string
     */
    public function getAction(string $code): string
    {
        return $this->getUrl($code);
    }

    public function redirectAction(string $code): void
    {
        $url = $this->getUrl($code);
        header('Location: ' . $url);
    }

    public function getUrl(string $code):string
    {
        return $this->urlOperator->getUrl($code);
    }

}