<?php

namespace Homework\PhpPro\Coder;

use Homework\PhpPro\Coder\Interfaces\IUrlStorage;
use Homework\PhpPro\ORM\ActiveRecord\Models\UrlCode;

class UrlStorageInDB implements IUrlStorage
{

    /**
     * @inheritDoc
     */
    public function getCodeByUrl(string $url): string
    {
        return UrlCode::getCodeByUrl($url);
    }

    /**
     * @inheritDoc
     */
    public function getUrlByCode(string $code): string
    {
        return UrlCode::getUrlByCode($code);
    }

    /**
     * @inheritDoc
     */
    public function saveCode(string $code, string $url): bool
    {
        return UrlCode::saveCode($code, $url);
    }
}