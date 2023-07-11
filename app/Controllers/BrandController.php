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

        $objectToInsert = new Brand();
        $objectToInsert->setName($name);

        if (! $objectToInsert->insert())
        {
            die();
        } 

        global $router;
        // une fois le formulaire traité on redirige l'utilisateur
        header('Location: ' . $router->generate('brand-browse'));

        exit;
    }

    public function edit($params)
    {
        // Récupérer l'identifiant de la catégorie à modifier à partir des paramètres de la route
        $brandId = $params["id"];

        // Récupérer la catégorie à partir de son identifiant
        $brandToModify = Brand::find($brandId);
        
        // Afficher le formulaire de modification de la catégorie
        $this->show('brand/edit', [
            'brandToModify' => $brandToModify
        ]);
    }

    public function editExecute($params)
    {
        $brandId = $params["id"];
        $brandToModify = Brand::find($brandId);
        
        $name = filter_input(INPUT_POST, 'name');

        $objectToModify = new Brand();
        $objectToModify->setName($name);
        

        // Enregistrer les modifications dans la base de données
        $brandToModify->update();

        // Rediriger l'utilisateur vers la liste des catégories
        global $router;
        header('Location: ' . $router->generate('brand-browse'));
        exit;
    }
}
