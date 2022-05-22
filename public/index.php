<?php
session_start();
if (!isset($_REQUEST['p'])) {
    header("Location:index.php?p=accueil");
    exit();
}
$vue = $_REQUEST['p'];

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

$bdd = $root . 'BDD' . DIRECTORY_SEPARATOR;
$controller = $root . 'controller' . DIRECTORY_SEPARATOR;
$elements = $root . 'elements' . DIRECTORY_SEPARATOR;
$vues = $root . 'vues' . DIRECTORY_SEPARATOR;

$css = ["main.css"];
$js = 'src/main.js';

require_once $root . 'BDD' . DIRECTORY_SEPARATOR . 'Commun.php';

$pdo = new Commun;

if ($pdo->is_connect()) {
    $myID = $_SESSION['id'];
    $avatar = $pdo->getInfosUser($myID)['avatar'];
    $nom = $pdo->getInfosUser($myID)['nom'];
    $prenom = $pdo->getInfosUser($myID)['prenom'];
    $type = $pdo->getInfosUser($myID)['type'];

    switch ($type) {
        case 'direction':
            array_push($css, "direction.css");
        break;

        case 'professeur':
        break;

        case 'etudiant':
        break;
    }
}

$typeAllowed = ["direction", "professeur", "etudiant"];
if (isset($_REQUEST['type'])) {
    $type = htmlentities(strtolower($_REQUEST['type']));
    if (!in_array($type, $typeAllowed)) {
        header("Location:index.php");
        exit();
    }

    switch ($type) {
        case 'direction':
            $_SESSION['icon'] = "fas fa-user-cog";
            $icon = $_SESSION['icon'];
        break;

        case 'professeur':
            $_SESSION['icon'] = "fas fa-user-tie";
            $icon = $_SESSION['icon'];
        break;

        case 'etudiant':
            $_SESSION['icon'] = "fas fa-user-graduate";
            $icon = $_SESSION['icon'];
        break;
    }
}

require_once $elements . 'header.php';

if (!$pdo->is_connect()) {
    switch ($vue) {
        case 'accueil':
            require_once $vues . 'accueil.php';
        break;
    
        case 'connexion':
            require_once $root . 'BDD' . DIRECTORY_SEPARATOR . 'Connexion.php';
            require_once $vues . 'connexion.php';
        break;
    
        case 'inscrire':
            require_once $root . 'BDD' . DIRECTORY_SEPARATOR . 'Inscription.php';
            require_once $vues . 'inscription.php';
        break;

        default:
            require_once $vues . '404.php';
        break;
    }
} else {
    switch ($type) {
        case 'direction':
            require_once $controller . 'direction.php';
        break;
    
        case 'professeur':
            require_once $controller . 'professeur.php';
        break;
        
        case 'etudiant':
            require_once $controller . 'etudiant.php';
        break;
    }
}

require_once $elements . 'footer.php';