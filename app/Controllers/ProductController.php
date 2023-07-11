<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class ProductController extends CoreController
{
    /**
     * Méthode s'occupant de l'affichage du formulaire d'ajout
     *
     * @return void
     */
    public function add()
    {
        // Préparer les données ( = en général les récupérer depuis la BDD )
        // dynamiser les listes de catégorie, marque et type
        $allCategoryList = Category::findAll();
        $allTypeList = Type::findAll();
        $allbrandList = Brand::findAll();

        // On appelle la méthode show() de l'objet courant
        $this->show('product/add', [
            'allCategoryList' => $allCategoryList,
            'allTypeList'=> $allTypeList,
            'allBrandList'=> $allbrandList,
        ]);
    }

    /**
     * Méthode s'occupant de l'affichage de la liste 
     *
     * @return void
     */
    public function browse()
    {
        // Préparer les données ( = en général les récupérer depuis la BDD )
        $allProductList = Product::findAll();
        // On appelle la méthode show() de l'objet courant
        $this->show('product/browse', [
            'productList'=>$allProductList
        ]);
    }

    /**
     * Méthode s'occupant d'exécuter l'ajout 
     *
     * @return void
     */
    public function addExecute(){
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $brandId = filter_input(INPUT_POST, 'brand_id', FILTER_VALIDATE_INT);
        $typeId = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

        $objectToInsert = new Product();
        $objectToInsert->setName($name);
        $objectToInsert->setDescription($description);
        $objectToInsert->setPicture($picture);
        $objectToInsert->setPrice($price);
        $objectToInsert->setRate($rate);
        $objectToInsert->setStatus($status);
        $objectToInsert->setCategoryId($categoryId);
        $objectToInsert->setBrandId($brandId);
        $objectToInsert->setTypeId($typeId);

        // si une erreur est survenue, on ne fait pas de redirection 
        // pour que l'on puisse avoir le message d'erreur
        if (! $objectToInsert->insert())
        {
            die();
        }

        // TODO se débarasser de ce global !!!!
        global $router;
        // une fois le formulaire traité on redirige l'utilisateur
        header('Location: ' . $router->generate('product-browse'));

        exit;
    }

     public function edit($params)
    {
        // Récupérer l'identifiant de la catégorie à modifier à partir des paramètres de la route
        $productId = $params["id"];

        // Récupérer la catégorie à partir de son identifiant
        $productToModify = Product::find($productId);
        
        // Afficher le formulaire de modification de la catégorie
        $this->show('product/edit', [
            'productToModify' => $productToModify
        ]);
    }

    public function editExecute($params)
    {
        $productId = $params["id"];
        $productToModify = Product::find($productId);
        
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $brandId = filter_input(INPUT_POST, 'brand_id', FILTER_VALIDATE_INT);
        $typeId = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

        $objectToModify = new Product();
        $objectToModify->setName($name);
        $objectToModify->setDescription($description);
        $objectToModify->setPicture($picture);
        $objectToModify->setPrice($price);
        $objectToModify->setRate($rate);
        $objectToModify->setStatus($status);
        $objectToModify->setCategoryId($categoryId);
        $objectToModify->setBrandId($brandId);
        $objectToModify->setTypeId($typeId);

        // Enregistrer les modifications dans la base de données
        $productToModify->update();

        // Rediriger l'utilisateur vers la liste des catégories
        global $router;
        header('Location: ' . $router->generate('product-browse'));
        exit;
    }
}
