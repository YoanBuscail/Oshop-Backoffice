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
        
        $this->redirectToRoute('brand-browse');
    }

    public function edit($id)
    {
        // Récupérer la catégorie à partir de son identifiant
        $brandToModify = Brand::find($id);
        
        // Afficher le formulaire de modification de la catégorie
        $this->show('brand/edit', [
            'brandToModify' => $brandToModify
        ]);
    }

    public function editExecute($id)
    {
        $brandToModify = Brand::find($id);
        
        $name = filter_input(INPUT_POST, 'name');

        $objectToModify = new Brand();
        $objectToModify->setName($name);
        

        // Enregistrer les modifications dans la base de données
        $brandToModify->update();

        $this->redirectToRoute('brand-browse');
    }

     /**
     * supprime un enregistrement en BDD
     *
     * @return void
     */
    public function delete($id)
    {
        Brand::delete($id);

        $this->redirectToRoute('brand-browse');
    }
}
