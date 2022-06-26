<?php
session_start();

if (!isset($_REQUEST['p'])) {
    header("Location:index.php?p=accueil");
    exit();
}
$vue = $_REQUEST['p'];

if (isset($_REQUEST['type'])) {
    $type = htmlentities(strtolower($_REQUEST['type']));
    if ($type !== 'direction' && $type !== 'professeur' && $type !== 'etudiant') {
        header("Location:index.php?p=accueil");
        exit();
    }
}

define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("BDD", ROOT . 'BDD' . DIRECTORY_SEPARATOR);
define("CONTROLLER", ROOT .  'controller' . DIRECTORY_SEPARATOR);
define("ELEMENTS", ROOT . 'elements' . DIRECTORY_SEPARATOR);
define("VUES", ROOT . 'vues' . DIRECTORY_SEPARATOR);

$css = ["generique.css"];
$js = 'src/main.js';

require_once ELEMENTS . 'helper.php';
require_once BDD . 'Commun.php';

$pdo = new Commun;

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

$erreurPage = '';
require_once ELEMENTS . 'header.php';

if (!$pdo->is_connect()) {
    require_once CONTROLLER . 'visiteur.php';
} else {
    require_once CONTROLLER . 'user.php';
}

if (isset($userErreurPage) || isset($visitorErreurPage)) {
    require_once VUES . '404.php';
}

require_once ELEMENTS . 'footer.php';