<?php

namespace Homework\PhpPro\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class UrlCode extends Model {
    protected $table = 'url_codes';
    protected $fillable = [
        'id',
        'url',
        'url_code',
    ];
    public $timestamps = false;

    /**
     * @param string $url
     * @return string
     */
    public static function getCodeByUrl(string $url): string
    {
        return (UrlCode::query()->where('url', $url)->firstOr(function () {
            throw new InvalidArgumentException('Запис в базі даних не знайдено');
        }))->url_code;
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getUrlByCode(string $code): string
    {
        return (UrlCode::query()->where('url_code', $code)->firstOr(function () {
            throw new InvalidArgumentException('Запис в базі даних не знайдено');
        }))->url;
    }

    /**
     * @param string $code
     * @param string $url
     * @return bool
     */
    public static function saveCode(string $code, string $url): bool
    {
        $urlCode = new UrlCode();
        $urlCode->url = $url;
        $urlCode->url_code = $code;
        return $urlCode->save();
    }
}