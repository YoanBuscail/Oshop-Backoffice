<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends CoreController {

    public function connect(){
        $this->show('user/connect');
    }

    public function connectExecute(){
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $userInDB = User::findByEmail($email);

        $errorList = [];

        if ($userInDB === false || $password !== $userInDB->getPassword())
        {
            $errorList[] = "Identifiant ou mot de passe incorrect";
            $this->show('user/connect', ['errorList' => $errorList]);
        }
        // une fois l'objet récupéré, comparer le password fourni et le password de l'objet
        else
        {
            $_SESSION['user_id'] = $userInDB->getId();
            $_SESSION['user_object'] = $userInDB;
        }

        $this->redirectToRoute('main-home');
        
    }   

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_object']);

        $this->redirectToRoute('user-connect');
    }
}