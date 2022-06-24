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

$css = ["generique.css"];
$js = 'src/main.js';

require_once $elements . 'helper.php';
require_once $elements . 'setIcon.php';
require_once $bdd . 'Commun.php';

$pdo = new Commun;

$erreurPage = '';
if ($pdo->is_connect()) {
    $myID = $_SESSION['identifiant'];
    $infos = $pdo->getInfosUser($myID);
    $avatar = $infos['avatar'];
    $nom = $infos['nom'];
    $prenom = $infos['prenom'];
    $type = $infos['type'];

    array_push($css, "user.css");

    switch ($type) {
        case 'direction':
            array_push($css, "direction.css");
        break;

        case 'professeur':
        break;

        case 'etudiant':
        break;
    }
} else {
    array_push($css, "visitor.css");
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
            $erreurPage = 'Page introuvable';
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

        default:
            $erreurPage = 'Type introuvable';
        break;
    }
}

if ($erreurPage !== '') {
    require_once $vues . '404.php';
}

require_once $elements . 'footer.php';