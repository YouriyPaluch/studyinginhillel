<?php

namespace Homework3\PhpPro\Models;

use Homework3\PhpPro\Interfaces\IUrlEncoder;

class UrlEncoder implements IUrlEncoder
{
    /**
     * @var string
     */
    protected $algo = 'crc32';


    /**
     * @param string $url
     * @return string
     */
    public function encode(string $url): string
    {
        return hash('crc32', $url);
    }

    /**
     * @param string $algo
     */
    public function setAlgo(string $algo): void {
        $this->algo = $algo;
    }

    /**
     * @return string
     */
    public function getAlgo(): string {
        return $this->algo;
    }
}