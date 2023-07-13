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

        $this->checkAuthorization(['admin']);
        
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
        
        $this->redirectToRoute('category-browse');
    }

    /**
     * Méthode s'occupant de l'affichage du formulaire de mise à jour
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        // Récupérer la catégorie à partir de son identifiant
        $categoryToModify = Category::find($id);

        // Afficher le formulaire de modification de la catégorie
        $this->show('category/edit', [
            'categoryToModify' => $categoryToModify
        ]);
    }

     /**
     * Méthode s'occupant du traitement du formulaire de mise à jour
     *
     * @param int $id
     * @return void
     */
    public function editExecute(int $id)
    {
        // 1 - récupérer les données
        $name = filter_input(INPUT_POST, 'name');
        $subtitle = filter_input(INPUT_POST, 'subtitle');
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

        // 2 - valider / nettoyer les données
        if (strlen($name) === 0)
        {
            // die arrête l'exécution du code
            // on gérera les erreurs plus tard
            die('Nom manquant');
        }
        if ($picture === false)
        {
            die('L\'image doit etre une url complète');
        }

        // 3 - traiter le formulaire

        // on récupère l'objet de la BDD
        $categoryToUpdate = Category::find($id);

        // puis on le rempli ( on l'hydrate ) avec les données saisies par l'utilisateur
        $categoryToUpdate->setName($name);
        $categoryToUpdate->setSubtitle($subtitle);
        $categoryToUpdate->setPicture($picture);

        // et on le sauvegarde en BDD
        $categoryToUpdate->save();

        // 4 - rediriger l'utilisateur
        $this->redirectToRoute('category-browse');

    }
    
    /**
     * supprime un enregistrement en BDD
     *
     * @return void
     */
    public function delete($id)
    {
        Category::delete($id);

        $this->redirectToRoute('category-browse');
    }
}
