<?php

namespace Homework\PhpPro\Models;

use Homework\PhpPro\Interfaces\IMyLogger;
use Homework\PhpPro\Interfaces\IUrlEncoder;
use EonX\EasyRandom\RandomGenerator;
use InvalidArgumentException;

class UrlEncoder implements IUrlEncoder
{
    /**
     * @param UrlStorage $storage
     * @param int $lengthCode
     */
    public function __construct(protected UrlStorage $storage, protected int $lengthCode = 8) {
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return string
     */
    public function encode(string $url): string
    {
        try {
            $code = $this->storage->getCodeByUrl($url);
        } catch (InvalidArgumentException $e) {
            $code = (new RandomGenerator())
                ->randomString(8)
                ->userFriendly();
            $this->storage->saveCode($code, $url);
        }
        return $code;
    }
}