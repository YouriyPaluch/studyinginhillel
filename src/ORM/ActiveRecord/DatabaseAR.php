<?php

namespace Homework\PhpPro\ORM\ActiveRecord;

use Illuminate\Database\Capsule\Manager;
class DatabaseAR {
    const DRIVER = 'mysql';
    const HOST = 'db_mysql';
    const PREFIX = '';
    const CHARSET = 'utf8';
    const COLLATION = 'utf8_unicode_ci';

    public function __construct(
        string $dataBase,
        string $user,
        string $pass,
        string $host = self::HOST,
        string $dbDriver = self::DRIVER,
        string $prefix = self::PREFIX,
        string $charset = self::CHARSET,
        string $collation = self::COLLATION
    ) {
        $dbManager = new Manager();
        $dbManager->addConnection([
            'driver' => $dbDriver,
            'host' => $host,
            'database' => $dataBase,
            'user' => $user,
            'password' => $pass,
            'charset' => $charset,
            'collation' => $collation,
            'prefix' => $prefix,
            'port' => 3306,
        ]);

        $dbManager->bootEloquent();
    }
}