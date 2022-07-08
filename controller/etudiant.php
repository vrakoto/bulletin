<?php
define("VUES_ETUDIANT", VUES_USER . 'etudiant' . DIRECTORY_SEPARATOR);

switch ($vue) {
    case 'accueil':
        require_once VUES_ETUDIANT . 'accueil.php';
    break;
    
    default:
        $erreurPage = $vue;
    break;
}