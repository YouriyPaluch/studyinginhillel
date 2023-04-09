<?php

namespace Homework\PhpPro\Coder;

use Homework\PhpPro\Coder\Interfaces\IMyLogger;
use Homework\PhpPro\Coder\Interfaces\IUrlDecoder;
use InvalidArgumentException;

class UrlDecoder implements IUrlDecoder {

    /**
     * @param UrlStorage $storage
     */
    public function __construct(protected UrlStorage $storage, protected IMyLogger $logger) {
    }

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
            $this->logger->log('Url was not found in file. Exception message: ' . $e->getMessage());
            return $e->getMessage();
        }
     }
}