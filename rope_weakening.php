<?php
/*
 *
 * Created by Waldemar Graban 2019
 *
 */

class Rope
{
    protected $strength;
    protected $knot;

    public function __construct($strength, $knot)
    {
        $this->strength = $strength;
        $this->knot     = $knot;
    }

    public function getKnot()
    {
        return $this->knot;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getStrengthAfterLoading()
    {
        if($this->getKnotDivider($this->knot) === 'death'){
            return 0;
        }

        $strength = $this->getStrength() - ($this->getStrength() * $this->getKnotDivider($this->knot));
        return $strength;
    }

    public function getDegreeOfWeakness()
    {
        return $this->getStrength() - $this->getStrengthAfterLoading();
    }

    public function getMaximumWeight()
    {
        return $this->getStrengthAfterLoading() * 100;
    }

    public function getResult()
    {
        if($this->getStrengthAfterLoading() === 0){
            return "Absolute ban on use!";
        }

        return 'Current rope strength is '   . $this->getStrengthAfterLoading() . ' kN'.
               '\nThe rope was weakened by ' . $this->getDegreeOfWeakness() . ' kN'.
               '\nThe maximum load is now '  . $this->getMaximumWeight() . ' kg';
    }

    public function getKnotDivider($knot)
    {
        switch ($knot) {
            case "Kluczka":
                return 0.50;
                break;
            case "Kluczka równoległa":
                return 0.56;
                break;
            case "Ósemka":
                return 0.45;
                break;
            case "Ósemka równoległa":
                return 0.52;
                break;
            case "Dziewiątka":
                return 0.30;
                break;
            case "Skrajny tatrzański":
                return 0.48;
                break;
            case "Motyl":
                return 0.49;
                break;
            case "Wyblinka":
                return 'death';
                break;
            case "Zderzakowy pojedynczy":
                return 0.60;
                break;
            case "Zderzakowy podwójny":
                return 0.44;
                break;
            case "Płaski i babski":
                return 'death';
                break;
            default:
                echo "Unsupported kont...";
        }
    }
}

$rope_strength = 16.9;                     // example 16,9 kN
$knot          = "Skrajny tatrzański";     // example

$rope = new Rope($rope_strength, $knot);

print $rope->getResult();
