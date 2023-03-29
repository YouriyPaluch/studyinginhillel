<?php

use Homework\PhpPro\Models\UrlOperator;



require_once __DIR__ . '/../vendor/autoload.php';

//$url = readline('Введіть url: ');
$url = 'https://google.com';

$filePath = 'public/url-code.txt';
$operator = new UrlOperator($filePath);
//echo $operator->startApplication($url);
echo $operator->startApplication('JKWZRJYN');
echo PHP_EOL;
