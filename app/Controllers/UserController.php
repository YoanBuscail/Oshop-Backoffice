<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends CoreController {

    public function connect(){
        $this->show('user/connect');
    }

    public function connectExecute(){
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        $errorList = [];

        if (empty($email)) {
            $errorList[] = "Veuillez indiquer une adresse email.";
        }
    
        if (empty($password)) {
            $errorList[] = "Veuillez indiquer un mot de passe.";
        }

        $user = User::findByEmail($email);

        if ($user) {
            if ($password === $user->getPassword()) {
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user;
                $_SESSION['connexionMessage'] = 'Connexion réussie';
                $this->redirectToRoute('main-home');
            } else {
                $errorList[] = "Erreur : Mot de passe incorrect.";
            }
        } else {
            $errorList[] = "Erreur : Identifiants invalides.";
        }

        $this->show('user/connect', ['errors' => $errorList]);
    }   
}