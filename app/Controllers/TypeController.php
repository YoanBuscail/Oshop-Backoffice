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

        /**
     * Méthode s'occupant d'exécuter l'ajout 
     *
     * @return void
     */
    public function addExecute(){
        $name = filter_input(INPUT_POST, 'name');

        $objectToInsert = new Type();
        $objectToInsert->setName($name);

        // si une erreur est survenue, on ne fait pas de redirection 
        // pour que l'on puisse avoir le message d'erreur
        if (! $objectToInsert->insert())
        {
            die();
        }
        
        $this->redirectToRoute('type-browse');
    }

    public function edit($id)
    {
        // Récupérer la catégorie à partir de son identifiant
        $typeToModify = Type::find($id);
        
        // Afficher le formulaire de modification de la catégorie
        $this->show('type/edit', [
            'typeToModify' => $typeToModify
        ]);
    }

    public function editExecute($id)
    {
        $typeToModify = Type::find($id);
        
        $name = filter_input(INPUT_POST, 'name');
        
        $objectToModify = new Type();
        $objectToModify->setName($name);

        // Enregistrer les modifications dans la base de données
        $typeToModify->update();

        // Rediriger l'utilisateur vers la liste
        $this->redirectToRoute('type-browse');
    }

     /**
     * supprime un enregistrement en BDD
     *
     * @return void
     */
    public function delete($id)
    {
        Type::delete($id);

        $this->redirectToRoute('type-browse');
    }
}
