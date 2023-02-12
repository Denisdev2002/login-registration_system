<?php

use Models\Acess\Login\Login;

require_once('../Models/Acess.php');
require_once('../Lib/DatabaseConnection.php');
require_once('../Models/Error.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && (!empty($_POST['password']))) {
        $user = new Login();
        $user->getEmail();
        $user->getPassword();
        $user->SQL();
        $user->getRowCount();
        if ($user->verificarUsuario() == true) {
            $_SESSION['msgUser'] = 'Bem vindo';
            header('Location: ../Views/Content.php');
        } elseif($user->verificarUsuario() == false){
            unset($user);
            $error = new ErrorMessage();
            $error->errorUser();
            $_SESSION['errorUser'];
            header('Location: ../Views/LoginScreen.php');
        }
    } else {
        header('Location: ../Views/LoginScreen.php');
    }
}