<?php

use GuzzleHttp\Client;
use Homework\PhpPro\Coder\UrlDecoder;
use Homework\PhpPro\Coder\UrlEncoder;
use Homework\PhpPro\Coder\UrlOperator;
use Homework\PhpPro\Coder\UrlStorage;
use Homework\PhpPro\Coder\UrlValidator;
use Homework\PhpPro\Core\Config;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use UfoCms\ColoredCli\CliColor;
use Homework\PhpPro\ORM\ActiveRecord\DatabaseAR;
use Homework\PhpPro\ORM\ActiveRecord\Models\UrlCode;

require_once __DIR__ . '/../vendor/autoload.php';

$connection = new PDO("mysql:host=db_mysql;dbname=php_pro", "korchevskii", "password");

$all = $connection->query("select * from url_codes")->fetchAll();
$databaseAr = new DatabaseAR(Config::get('db.name'), Config::get('db.login'), Config::get('db.password'));
$er = 321;
$urlCode = UrlCode::all();
$e = 123;
////$url = readline('Введіть url: ');
////$url = 'https://google.com';
//$url = 'PN8K7N2W';
//
//$logger = new Logger('coder');
//$logger->pushHandler(new StreamHandler(Config::get('logFile'), Level::Notice));
//
//$storage = new UrlStorage(Config::get('dbFile'));
//$validator = new UrlValidator(new Client(), $logger);
//$encoder = new UrlEncoder($storage);
//$decoder = new UrlDecoder($storage, $logger);
//
//
//$operator = new UrlOperator($storage, $validator, $encoder, $decoder);
//$text = $operator->startApplication($url);
//
//echo CliColor::GREEN->value . $text . CliColor::RESET->value;

echo PHP_EOL;
