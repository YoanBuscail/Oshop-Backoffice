<?php

namespace App\Controllers;

use App\Models\Category;
use App\Utils\Database;
use PDO;

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
        $name = filter_input(INPUT_POST, 'name');
        $subtitle = filter_input(INPUT_POST, 'subtitle');
        $picture = filter_input(INPUT_POST, 'picture');

        $category = new Category();
        $category->setName($name);
        $category->setPicture($picture);
        $category->setSubtitle($subtitle);

        $category->insert();
        
    }

    public function edit($id){
        $id = $_GET["id"];
        $categoryToEdit = Category::find($id);

        $this->show('category/edit', [
            'categoryToEdit'=>$categoryToEdit
        ]);
    }

}
