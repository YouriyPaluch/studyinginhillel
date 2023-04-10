<?php

namespace Homework\PhpPro\Coder;


use Homework\PhpPro\Coder\Interfaces\IUrlDecoder;
use Monolog\Logger;
use InvalidArgumentException;

class UrlDecoder implements IUrlDecoder
{

    /**
     * @param UrlStorage $storage
     * @param Logger $logger
     */
    public function __construct(protected UrlStorage $storage, protected Logger $logger)
    {}

    /**
     * @param string $code
     * @throws InvalidArgumentException
     * @return string
     */
    public function decode(string $code): string
    {
        try {
            return $this->storage->getUrlByCode($code);
        } catch (InvalidArgumentException $e) {
            $this->logger->error('Url was not found in file. Exception message: ' . $e->getMessage());
            throw $e;
        }
     }
}