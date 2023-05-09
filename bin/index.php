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

require_once __DIR__ . '/../vendor/autoload.php';
new DatabaseAR(Config::get('db.name'), Config::get('db.username'), Config::get('db.password'));

$url = readline(CliColor::BLUE->value . 'Введіть url:' . CliColor::RESET->value . PHP_EOL);
//$url = 'https://google.com';
//$url = 'D3TV9B78';

$logger = new Logger('coder');
$logger->pushHandler(new StreamHandler(Config::get('logFile'), Level::Notice));

$storageType = readline(CliColor::GREEN->value . 'Виберіть місце зберігання: F чі D, де F - файл, D - база данних' . CliColor::RESET->value . PHP_EOL);
//$storageType = 'F';
$methodName = 'getUrlStorage' . $storageType;

if (method_exists(UrlStorage::class, $methodName)) {
    $storage = UrlStorage::$methodName();
    $validator = new UrlValidator(new Client(), $logger);
    $encoder = new UrlEncoder($storage);
    $decoder = new UrlDecoder($storage, $logger);

    $operator = new UrlOperator($storage, $validator, $encoder, $decoder);
    $text = $operator->startApplication($url);
    echo CliColor::GREEN->value . $text . CliColor::RESET->value;
} else {
    echo CliColor::RED->value . 'Неправильний вибір сховища' . CliColor::RESET->value;
}

echo PHP_EOL;
