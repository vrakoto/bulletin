<?php
switch ($vue) {
    case 'accueil':
        require_once VUES . 'accueil.php';
    break;

    case 'connexion':
        require_once ROOT . 'BDD' . DIRECTORY_SEPARATOR . 'Connexion.php';
        require_once VUES . 'connexion.php';
    break;

    case 'inscrire':
        require_once ROOT . 'BDD' . DIRECTORY_SEPARATOR . 'Inscription.php';
        require_once VUES . 'inscription.php';
    break;

    default:
        $visitorErreurPage = TRUE;
    break;
}