<?php

use Homework\PhpPro\Models\UrlOperator;

require_once __DIR__ . '/../vendor/autoload.php';

$url = readline('Введіть url: ');
//$url = 'https://google.com';

$filePath = 'public/';
$operator = new UrlOperator($filePath);
echo $operator->startApplication($url);
//echo $operator->startApplication('');
echo PHP_EOL;
