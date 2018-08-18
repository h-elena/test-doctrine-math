<?php

class Geometry
{
    /**
     * @param $mas
     * @return array
     * @throws Exception
     */
    public function calcCutView(array $mas): array
    {
        if ($this->checkPoints($mas)) {
            $a1 = [$mas[0][0], $this->geCoordinateRand(0, $mas[0][1])];

            $x = $this->geCoordinateRand($mas[0][0], $mas[1][0]);
            $a2 = [$x, $this->geCoordinateInLine($mas[0], $mas[1], $x)];

            $x = $this->geCoordinateRand($a2[0], $mas[1][0]);
            $b1 = [$x, $this->geCoordinateInLine($mas[0], $mas[1], $x)];

            $x = $this->geCoordinateRand($mas[1][0], $mas[2][0]);
            $b2 = [$x, $this->geCoordinateInLine($mas[1], $mas[2], $x)];

            $x = $this->geCoordinateRand($b2[0], $mas[2][0]);
            $c1 = [$x, $this->geCoordinateInLine($mas[1], $mas[2], $x)];

            $c2 = [$mas[2][0], $this->geCoordinateRand($mas[2][1], $mas[1][1])];

            return [
                [$a1, $mas[0], $a2],
                [$b1, $mas[1], $b2],
                [$c1, $mas[2], $c2]
            ];
        }

    }

    /**
     * @return float|int
     */
    protected function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }

    /**
     * @param $mas
     * @return bool
     * @throws Exception
     */
    protected function checkPoints(array $mas): bool
    {
        if ($mas[0][0] > $mas[1][0]) {
            throw new Exception('The first coordinate of the second point must be greater than the first coordinate of the first point');
        }

        if ($mas[0][1] > $mas[1][1]) {
            throw new Exception('The second coordinate of the second point must be greater than the second coordinate of the first point');
        }

        if ($mas[1][0] > $mas[2][0]) {
            throw new Exception('The first coordinate of the third point must be greater than the first coordinate of the second point');
        }

        if ($mas[2][1] < $mas[0][1]) {
            throw new Exception('The second coordinate of the third point must be greater than the second coordinate of the first point');
        }

        if ($mas[2][1] > $mas[1][1]) {
            throw new Exception('The second coordinate of the third point must be less than the second coordinate of the second point');
        }

        return true;
    }

    /**
     * @param $min
     * @param $max
     * @return float
     */
    protected function geCoordinateRand($min, $max): float
    {
        mt_srand($this->make_seed());
        $diff = $max - $min;

        if ($diff > 3) {
            $coord = mt_rand(($min + 1), ($max - 1));
        } elseif ($diff == 3) {
            $coord = $min + mt_rand(0, 2) + lcg_value();
        } elseif ($diff >= 2 && $diff < 3) {
            $coord = $min + mt_rand(0, 1) + lcg_value();
        } elseif ($diff > 1 && $diff < 2) {
            $coord = $min + lcg_value();
        } else {
            $coord = $min + lcg_value();
        }

        return $coord;
    }

    /**
     * @param array $X1
     * @param array $X2
     * @param float $x
     * @return float
     */
    protected function geCoordinateInLine(array $X1, array $X2, float $x): float
    {
        $y = ($x - $X1[0]) * ($X2[1] - $X1[1]) / ($X2[0] - $X1[0]) + $X1[1];

        $diff = $X2[1] - $X1[1];

        if ($diff >= 3) {
            $y = round($y);
        }

        return $y;
    }
}