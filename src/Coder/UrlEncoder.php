<?php

namespace Homework\PhpPro\Coder;

use EonX\EasyRandom\RandomGenerator;
use Homework\PhpPro\Coder\Interfaces\IUrlEncoder;
use Homework\PhpPro\Coder\Interfaces\IUrlStorage;
use InvalidArgumentException;

class UrlEncoder implements IUrlEncoder
{
    /**
     * @param IUrlStorage $storage
     * @param RandomGenerator $randomGenerator
     * @param int $lengthCode
     */
    public function __construct(
        protected IUrlStorage $storage,
        protected RandomGenerator $randomGenerator = new RandomGenerator(),
        protected int $lengthCode = 8
    )
    {}

    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return string
     */
    public function encode(string $url): string
    {
        try {
            $code = $this->storage->getCodeByUrl($url);
        } catch (InvalidArgumentException) {
            $code = $this->randomGenerator
                ->randomString($this->lengthCode)
                ->userFriendly();
            $this->storage->saveCode($code, $url);
        }
        return $code;
    }
}