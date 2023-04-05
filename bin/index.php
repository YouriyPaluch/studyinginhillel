<?php

use GuzzleHttp\Client;
use Homework\PhpPro\Models\MyLogger;
use Homework\PhpPro\Models\UrlDecoder;
use Homework\PhpPro\Models\UrlEncoder;
use Homework\PhpPro\Models\UrlOperator;
use Homework\PhpPro\Models\UrlStorage;
use Homework\PhpPro\Models\UrlValidator;
use UfoCms\ColoredCli\CliColor;

require_once __DIR__ . '/../vendor/autoload.php';

//$url = readline('Введіть url: ');
$url = 'https://google.com';
//$url = 'PN8K7N2W';

$filePath = 'public/';

$storage = new UrlStorage($filePath . 'url-code.txt');
$logger = new MyLogger($filePath);
$validator = new UrlValidator(new Client(), $logger);
$encoder = new UrlEncoder($storage);
$decoder = new UrlDecoder($storage, $logger);


$operator = new UrlOperator($storage, $logger, $validator, $encoder, $decoder);
$text = $operator->startApplication($url);

echo CliColor::RED->value . $text . CliColor::RESET->value;

echo PHP_EOL;
