<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends CoreController
{
    /**
     * Méthode s'occupant de l'affichage de la liste des catégories
     *
     * @return void
     */
    public function browse()
    {
        // Préparer les données ( = en général les récupérer depuis la BDD )
        $allCategoryList = Category::findAll();
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('category/browse', [
            'categoryList'=>$allCategoryList
        ]);
    }

    /**
     * Méthode s'occupant de l'affichage du formulaire d'ajout
     *
     * @return void
     */
    public function add(){
        $this->show('category/add');
    }
    
    /**
     * Méthode s'occupant d'exécuter l'ajout 
     *
     * @return void
     */
    public function addExecute(){
        // récupérer les données
        $name = filter_input(INPUT_POST, 'name');
        $subtitle = filter_input(INPUT_POST, 'subtitle');
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

         // NTUI ( nettoyage / validation des données )
        // Les validations faites cotés FRONT ( dans le navigateur ) peuvent toutes être contournées
        // Il FAUT vérifier les données cotés back
        //  - la cohérence des données ( est ce que les données sont valides )
        //  - la complétude ? des données ( est ce qu'on a toutes les données nécessaires )
        // TODO traiter les erreurs

        // traiter le formulaire
        // dans ce cas insérer en BDD

        // on crée un modèle 
        $categoryToInsert = new Category();

        // que l'on rempli ( on l'hydrate ) avec les données saisies par l'utilisateur

        $categoryToInsert->setName($name);
        $categoryToInsert->setPicture($picture);
        $categoryToInsert->setSubtitle($subtitle);

        // on lance la requête d'insertion
        $categoryToInsert->insert();
        
        // TODO se débarasser de ce global !!!!
        global $router;
        // une fois le formulaire traité on redirige l'utilisateur
        header('Location: ' . $router->generate('category-browse'));

        exit;
    }

    public function edit($params)
    {
        // Récupérer l'identifiant de la catégorie à modifier à partir des paramètres de la route
        $categoryId = $params["id"];

        // Récupérer la catégorie à partir de son identifiant
        $categoryToModify = Category::find($categoryId);

        // Afficher le formulaire de modification de la catégorie
        $this->show('category/edit', [
            'categoryToModify' => $categoryToModify
        ]);
    }

    public function editExecute($params){
        $categoryId = $params["id"];
        $categoryToModify = Category::find($categoryId);
        
        // Récupérer les nouvelles données du formulaire de modification
        $name = filter_input(INPUT_POST, 'name');
        $subtitle = filter_input(INPUT_POST, 'subtitle');
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

        // Mettre à jour les propriétés de la catégorie
        $categoryToModify->setName($name);
        $categoryToModify->setSubtitle($subtitle);
        $categoryToModify->setPicture($picture);

        // Enregistrer les modifications dans la base de données
        $categoryToModify->update();

        // Rediriger l'utilisateur vers la liste des catégories
        global $router;
        header('Location: ' . $router->generate('category-browse'));
        exit;
    }
}
