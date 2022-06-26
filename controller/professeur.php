<?php
$vuesProfesseur = $root . 'vues' . DIRECTORY_SEPARATOR . 'professeur' . DIRECTORY_SEPARATOR;

switch ($vue) {
    case 'accueil':
        require_once $vuesProfesseur . 'accueil.php';
    break;

    case 'deconnexion':
        session_destroy();
        header("Location:index.php");
        exit();
    break;
    
    default:
        $erreurPage = $vue;
    break;
}