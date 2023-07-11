<?php

namespace App\Controllers;

use App\Models\Brand;

class BrandController extends CoreController
{
    /**
     * Méthode s'occupant de l'affichage de la liste
     *
     * @return void
     */
    public function browse()
    {
        
        $allBrandList = Brand::findAll();
        
        $this->show('brand/browse', [
            'brandList'=>$allBrandList
        ]);
    }

    /**
     * Méthode s'occupant de l'affichage du formulaire d'ajout
     *
     * @return void
     */
    public function add(){
        $this->show('brand/add');
    }

    /**
     * Méthode s'occupant d'exécuter l'ajout 
     *
     * @return void
     */
    public function addExecute(){
        $name = filter_input(INPUT_POST, 'name');
        $picture = filter_input(INPUT_POST, 'picture');

        $brand = new Brand();
        $brand->setName($name);

        $brand->insert();   
    }
}
