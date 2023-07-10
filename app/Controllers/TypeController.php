<?php

namespace App\Controllers;

use App\Models\Type;

class TypeController extends CoreController
{
    /**
     * Méthode s'occupant de l'affichage de la liste
     *
     * @return void
     */
    public function browse()
    {
        
        $alltypeList = Type::findAll();
        
        $this->show('type/browse', [
            'typeList'=>$alltypeList
        ]);
    }

    /**
     * Méthode s'occupant de l'affichage du formulaire d'ajout
     *
     * @return void
     */
    public function add(){
        $this->show('type/add');
    }
}
