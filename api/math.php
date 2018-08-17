<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . "/../vendor/autoload.php";

$A = [10, 4];
$B = [24, 70];
$C = [30, 15];

$points = [
    $A, $B, $C
];

echo '<pre>';
print_r($points);
echo '</pre>';

$obj = new Geometry();
$obj->calcCutView($points);