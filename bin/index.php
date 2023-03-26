<?php
require_once __DIR__ . '/../bin/autoload.php';
use Homework3\PhpPro\Models\UrlOperator;

$url = readline('Введіть url: ');

$filePath = 'public/files/url-code.txt';
$operator = new UrlOperator($filePath);
echo $operator->getUrlCode($url);
echo $operator->getUrl('5daaaa2a');
echo PHP_EOL;
