<?php

namespace App\Controllers;

class CoreController
{
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Comme $viewData est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewData['currentPage'] = $viewName;

        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . '/assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }

    protected function redirectToRoute($routeName)
    {
        // TODO se débarasser de ce global !!!!
        global $router;
        // une fois le formulaire traité on redirige l'utilisateur
        header('Location: ' . $router->generate($routeName));

        exit;
    }

    /**
     * Vérifie si l'utilisateur connecté a un des roles fournis
     *
     * @param array $authorizedRoles
     * @return void
     */
    protected function checkAuthorization($authorizedRoles)
    {
        // si l'utilisateur n'est pas connecté
        if(! isset($_SESSION['user_id']))
        {
            // alors rediriger vers la page de connexion
            $this->redirectToRoute('main-login');
        }
        else
        {
            $connectedUser = $_SESSION['user_object'];
            // sinon si elle n'a pas un des roles requis 
            // if (in_array($connectedUser->getRole(), $authorizedRoles) === false)
            if (! in_array($connectedUser->getRole(), $authorizedRoles))
            {
                // alors on affiche une page 403
                // ce code 403 n'est intéressant que pour les machines
                http_response_code(403);
                die("Vous n'avez pas les droits");
            }
        }
    }
}
