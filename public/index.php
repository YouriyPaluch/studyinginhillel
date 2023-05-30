<?php

use GuzzleHttp\Client;
use Homework\PhpPro\Coder\UrlDecoder;
use Homework\PhpPro\Coder\UrlEncoder;
use Homework\PhpPro\Coder\UrlOperator;
use Homework\PhpPro\Coder\UrlStorage;
use Homework\PhpPro\Coder\UrlValidator;
use Homework\PhpPro\Core\Config;
use Homework\PhpPro\Core\CoderController;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Homework\PhpPro\ORM\ActiveRecord\DatabaseAR;

require_once __DIR__ . '/../vendor/autoload.php';
new DatabaseAR(
    Config::get('db.name', '../config/'),
    Config::get('db.username', '../config/'),
    Config::get('db.password', '../config/')
);
$requestDataList = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
$controllerName = ucwords(array_shift($requestDataList));
$controllerClass = 'Homework\PhpPro\Core\\' . $controllerName . 'Controller';
$actionNameString = explode('?', $requestDataList[0])[0];
$actionNameCamelCase = str_replace(' ', '', ucwords(str_replace('-', ' ', $actionNameString)));
$actionName = lcfirst($actionNameCamelCase);
$action = $actionName . 'Action';

$operationData = isset($_GET['url']) ? 'https://' . $_GET['url'] : $_GET['code'];

$logger = new Logger('coder');
$logger->pushHandler(new StreamHandler(Config::get('web.logFile', '../config/'), Level::Notice));

$storageType = 'D';
$methodName = 'getUrlStorage' . $storageType;

try {
    $storage = UrlStorage::$methodName();
    $validator = new UrlValidator(new Client(), $logger);
    $encoder = new UrlEncoder($storage);
    $decoder = new UrlDecoder($storage, $logger);
    $operator = new UrlOperator($storage, $validator, $encoder, $decoder);
    $controller = new CoderController($operator);
    $text = $controller->{$action}($operationData);
    echo $text;
} catch (Exception $e) {
    echo 'Доступні варіанти URL: <br> /coder/add?url=site.com <br> /coder/get?code=code <br> /coder/redirect?url=code';
}


echo PHP_EOL;