<?php

$app_version = '2.0.3';

if (in_array($app_version, ['2.0.1', '2.0.2'])) {
    $app_version = '2.0.1';
}

if ($app_version > '2.1.0') {
    $pos         = strrpos($app_version, '.');
    $prefix      = substr($app_version, 0, $pos + 1);
    $app_version = $prefix . '0';
}

var_dump($app_version);exit;
echo "hello world";
