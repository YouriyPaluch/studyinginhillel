<?php
require_once __DIR__ . '/../src/autoload.php';
use Homework3\PhpPro\Models\UrlOperator;

$url = readline('Введіть url: ');

$filePath = 'public/url-code.txt';
$operator = new UrlOperator($filePath);
echo $operator->getUrlCode($url);
//echo $operator->getUrl('ee5436ca');
echo PHP_EOL;
