<?php

class Geometry
{
    public function calcCutView($mas)
    {
        if ($this->checkPoints($mas)) {
            $a1 = [$mas[0][0], $this->getCoordinate(0, $mas[0][1])];
            echo '<pre>';
            print_r($a1);
            echo '</pre>';
            $a2 = [$this->getCoordinate($mas[0][0], $mas[1][0]), $this->getCoordinate($mas[0][1], $mas[1][1])];
            echo '<pre>';
            print_r($a2);
            echo '</pre>';

            $b1 = [$mas[0][0], $this->getCoordinate($mas[0][0], $mas[1][0], $mas[0][1])];
            echo '<pre>';
            print_r($a1);
            echo '</pre>';
        }

    }

    protected function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }

    protected function checkPoints($mas)
    {
        if ($mas[0][0] > $mas[1][0]) {
            throw new Exception('The first coordinate of the second point must be greater than the first coordinate of the first point');
        }

        if ($mas[0][1] > $mas[1][1]) {
            throw new Exception('The second coordinate of the second point must be greater than the second coordinate of the first point');
        }

        return true;
    }

    protected function getCoordinate($min, $max)
    {
        mt_srand($this->make_seed());
        $diff = $max - $min;

        if ($diff >= 3) {
            $coord = mt_rand(($min + 1), ($max - 1));
        } elseif ($diff >= 1 && $diff < 3) {
            $coord = $min + $diff + lcg_value();
        } else {
            $coord = $min + lcg_value();
        }

        return $coord;
    }
}