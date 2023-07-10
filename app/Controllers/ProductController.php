<?php

namespace App\Controllers;

use App\Models\Product;

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

        // On appelle la méthode show() de l'objet courant
        $this->show('product/add');
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
}
