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
        $this->checkAuthorization(['admin']);

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

        global $router;
        
        $this->redirectToRoute('product-browse');
    }

     public function edit($id)
    {
        $productToModify = Product::find($id);
        $allCategoryList = Category::findAll();
        $allBrandList = Brand::findAll();
        $allTypeList = Type::findAll();
        
        $this->show('product/edit', [
            'productToModify' => $productToModify,
            'allCategoryList' => $allCategoryList,
            'allBrandList' => $allBrandList,
            'allTypeList' => $allTypeList,
        ]);
    }

    public function editExecute($id)
    {
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $brandId = filter_input(INPUT_POST, 'brand_id', FILTER_VALIDATE_INT);
        $typeId = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);

        $objectToUpdate = Product::find($id);
        
        $objectToUpdate->setName($name);
        $objectToUpdate->setDescription($description);
        $objectToUpdate->setPicture($picture);
        $objectToUpdate->setPrice($price);
        $objectToUpdate->setRate($rate);
        $objectToUpdate->setStatus($status);
        $objectToUpdate->setCategoryId($categoryId);
        $objectToUpdate->setBrandId($brandId);
        $objectToUpdate->setTypeId($typeId);

        // Enregistrer les modifications dans la base de données
        if (! $objectToUpdate->save())
        {
            die();
        }

        // Rediriger l'utilisateur vers la liste des catégories        
        $this->redirectToRoute('product-browse');
    }

    /**
     * supprime un enregistrement en BDD
     *
     * @return void
     */
    public function delete($id)
    {
        Product::delete($id);

        $this->redirectToRoute('product-browse');
    }
}
