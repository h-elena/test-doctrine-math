<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . "/../vendor/autoload.php";

$A = [10, 18];
$B = [24, 70];
$C = [30, 35];

$points = [
    $A, $B, $C
];

echo '<pre>';
print_r($points);
echo '</pre>';

$obj = new Geometry();
$newPoints = $obj->calcCutView($points);

echo '<pre>';
print_r($newPoints);
echo '</pre>';
$allPoints = [];
if (!empty($newPoints)) {
    $allPoints = [['x', 'y']];
    foreach ($newPoints as $points) {
        foreach ($points as $point) {
            $allPoints[] = $point;
        }
    }
}