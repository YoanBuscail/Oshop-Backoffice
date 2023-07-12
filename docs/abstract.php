<?php

/*
Abstract permet de ne pas avoir de concret sur un élément :

- pour une classe abstraite, on ne peut pas instancier d'objet de cette classe
- pour une fonction, elle ne possède pas de bloc de code à exécuter

Ce qu'il faut retenir : 

- On ne peut pas instancier une classe abstraite
- Une classe qui contient une méthode abstraite doit être abstraite
- Les enfants d'une classe qui contient une méthode abstraite doivent :
    - implémenter le corps de toutes les fonctions abstraites du parent
    - OU
    - être abstraite elles même
*/
require __DIR__ . '/app/Controllers/CoreController.php';
require __DIR__ . '/app/Controllers/ErrorController.php';

use App\Controllers\CoreController;
use App\Controllers\ErrorController;

$controller = new ErrorController();

// Pourquoi ca marche pas ?
$controller->err404();
