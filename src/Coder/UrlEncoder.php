<?php

namespace Homework\PhpPro\Coder;

use EonX\EasyRandom\RandomGenerator;
use Homework\PhpPro\Coder\Interfaces\IUrlEncoder;
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