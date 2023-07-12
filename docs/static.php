<?php

/*
static permet de créer une propriété ou une méthode accessible ( en lecture / écriture ) sans avoir à créer d'objets
Corrollaire : 
je ne peux pas rendre une fonction static si j'utilise `$this` à l'intérieur
Si une méthode n'utilise pas de $this alors je peux la rendre static
*/ 

$nbInstance = 0;

class StaticExample
{
    // on utilise le meme opérateur pour accéder aux constantes de classes
    const TEST_CONSTANTE = 2;

    public static $staticProperty = 3;
    public static $staticNbInstance = 0;
    public $nonStaticName;

    public function __construct()
    {
        StaticExample::$staticNbInstance++;
    }

    public static function test()
    {
        // self == le nom de la classe dans laquelle se trouve le code
        echo self::$staticNbInstance ;
    }

    public function test2()
    {
        echo self::$staticNbInstance ;
    }
}



$objetA = new StaticExample();
$nbInstance++;

$objetA->nonStaticName = 'A';

$objetB = new StaticExample();
$nbInstance++;
$objetB->nonStaticName = 'B';

var_dump($objetA);
var_dump($objetB);

var_dump(StaticExample::$staticProperty);
var_dump($nbInstance . ' objets ont été instanciés');
var_dump(StaticExample::$staticNbInstance . ' objets ont été instanciés 2');

$objetA->test();
$objetB->test();


$pbjetC = new StaticExample();
$objetC->test();
StaticExample::test();