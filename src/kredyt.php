<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Kawa³kowski
 * Date: 2015-09-27
 * Time: 22:47
 */
/*
 * $p = wartoœæ oprocentowania w stosunku rocznym w %
 * $k = wartoœæ po¿yczonego kapita³u
 * $n = liczba rat miesiêcznych

 * $s = system sp³aty
 *
 */


class Kredyt
{

    private $k;
    private $p;
    private $n;
    private $s;
    public $splaty;
    public $odsetkiTablica;
    public $kapitalTablica;

    public function __construct($newK, $newP, $newN, $newS)
    {
        $this->k = $newK;
        $this->p = $newP;
        $this->n = $newN;
        $this->s = $newS;
    }

    public function setK($k)
    {
        if (is_numeric($k) && $k > 0) {
            $newK = $k;
        } else {
            return False;
        }
    }

    public function setP($p)
    {
        if (is_numeric($p) && $p > 0) {
            $newP = $p;
        } else {
            return False;
        }
    }

    public function setN($n)
    {
        if (is_int($n) && $n > 0 && $n < 1200) {
            $newN = $n;
        } else {
            return False;
        }
    }

    public function sets($s)
    {
        $newS = $s;
    }

    public function obliczK()
    {
        if ($this->s == true) {

            $this->ratyRowne();
        } else {
            $this->ratyMalejace();
        }
    }

    private function ratyRowne()
    {
        $this->wspolczynnikq();
        $r = ($this->k * pow($this->wspolczynnikq(), $this->n) * ($this->wspolczynnikq() - 1)) / (pow($this->wspolczynnikq(), $this->n) - 1);
        $harmonogram = array();
        for ($i = 0; $i < $this->n; $i++) {
            $harmonogram[$i] = round($r, 2);
        }
        $this->setSplaty($harmonogram);
        return $harmonogram;
    }

    private function wspolczynnikq()
    {
        $q = 1 + (1 / 12) * ($this->p / 100);
        return $q;
    }

    private function ratyMalejace()
    {

        $rataKapitalowa = round($this->k / $this->n, 2);
        $harmonogram = array();
        $rataOdsetkowa = array();
        for ($i = 0; $i < $this->n; $i++) {
            $rataOdsetkowa[$i] = round(((($this->k - $rataKapitalowa * $i) * $this->p / 100) / 12), 2);
            $harmonogram[$i] = ($rataOdsetkowa[$i] + $rataKapitalowa);
            if ($harmonogram[$i] < 0.01) {
                $harmonogram[$i] = '';
            }
            if ($rataOdsetkowa[$i] < 0.01) {
                $rataOdsetkowa[$i] = '';
            }
        }
        $this->setSplaty($harmonogram);
        return $harmonogram;
    }

    private function setSplaty($harmonogram)
    {
        $this->splaty = $harmonogram;
    }

    public function odsetkiKapital()
    { //oblicza i odsetki i kapita³ dla dowolnej metody sp³aty
        $this->obliczK();
        $i = count($this->splaty);
        $odsetkiTablica = array();
        $kapitalTablica = array();

        $kapital = $this->k;
        for ($n = 0; $n < $i; $n++) {
            $rataOdsetki = $kapital * $this->p / 100 / 12;
            $rataKapital = $this->splaty[$n] - $rataOdsetki;
            $kapital = $kapital - $rataKapital;
            $odsetkiTablica[$n] = $rataOdsetki;
            $kapitalTablica[$n] = $rataKapital;

        }
        $this->kapitalTablica = $kapitalTablica;
        $this->odsetkiTablica = $odsetkiTablica;

    }
}




