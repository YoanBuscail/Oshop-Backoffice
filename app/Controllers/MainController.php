<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

// Si j'ai besoin du Model Category
// use App\Models\Category;


class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
        
    public function home()
    {
        $model = new Category();
        $categoriesForHomePage = $model->findAllBackofficeHomepage();

        $model = new Product();
        $productsForHomePage = $model->findAllBackofficeHomepage();

        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home',[
            'categoriesForHomePage' => $categoriesForHomePage,
            'productsForHomePage' => $productsForHomePage
        ]);
    }

    public function categoriesList(){

        $model = new Category();
        $categoriesList = $model->findAll();

        $this->show('main/categoriesList', [
            'categoriesList'=>$categoriesList
        ]);
    }

    public function addCategory(){
        $this->show('main/addCategory');
    }

    public function brandsList(){

        $model = new Brand();
        $brandsList = $model->findAll();

        $this->show('main/brandsList',[
        'brandsList'=>$brandsList
        ]);
    }

    public function addBrand(){
        $this->show('main/addBrand');
    }

    public function productsList(){
        $model = new Product();
        $productsList = $model->findAll();
        
        $this->show('main/productsList',[
        'productsList'=>$productsList
        ]);
    }

    public function addProduct(){
        $this->show('main/addProduct');
    }
}
