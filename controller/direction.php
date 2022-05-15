<?php
$vuesDirection = $root . 'vues' . DIRECTORY_SEPARATOR . 'direction' . DIRECTORY_SEPARATOR;

switch ($vue) {
    case 'accueil':
        require_once $vuesDirection . 'accueil.php';
    break;

    case 'deconnexion':
        session_destroy();
        header("Location:index.php");
        exit();
    break;
    
    default:
        # code...
    break;
}