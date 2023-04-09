<?php

use GuzzleHttp\Client;
use Homework\PhpPro\Coder\MyLogger;
use Homework\PhpPro\Coder\UrlDecoder;
use Homework\PhpPro\Coder\UrlEncoder;
use Homework\PhpPro\Coder\UrlOperator;
use Homework\PhpPro\Coder\UrlStorage;
use Homework\PhpPro\Coder\UrlValidator;
use Homework\PhpPro\Core\Config;
use Monolog\Logger;
use UfoCms\ColoredCli\CliColor;

require_once __DIR__ . '/../vendor/autoload.php';
//$url = readline('Введіть url: ');
$url = 'http://goo.code';
//$url = 'PN8K7N2W';

$storage = new UrlStorage(Config::get('dbFile'));
$logger = new MyLogger(Config::get('logFile'), new Logger('coder'));
$validator = new UrlValidator(new Client(), $logger);
$encoder = new UrlEncoder($storage);
$decoder = new UrlDecoder($storage, $logger);


$operator = new UrlOperator($storage, $logger, $validator, $encoder, $decoder);
$text = $operator->startApplication($url);

echo CliColor::RED->value . $text . CliColor::RESET->value;

echo PHP_EOL;
