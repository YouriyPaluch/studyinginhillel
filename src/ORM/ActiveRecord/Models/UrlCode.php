<?php

namespace Homework\PhpPro\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;

class UrlCode extends Model {
    protected $table = 'url_codes';
    protected $fillable = [
        'id',
        'url',
        'url_code',
    ];
    public $timestamps = false;
}